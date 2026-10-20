<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_code',
        'project_name',
        'client_id',
        'project_manager_id',
        'budget',
        'expected_profit',
        'planned_start_date',
        'planned_end_date',
        'actual_start_date',
        'actual_end_date',
        'status',
        'health_score',
        'currency',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'budget' => 'decimal:2',
            'expected_profit' => 'decimal:2',
            'health_score' => 'decimal:2',
            'planned_start_date' => 'date',
            'planned_end_date' => 'date',
            'actual_start_date' => 'date',
            'actual_end_date' => 'date',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function projectManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'project_manager_id');
    }

    public function stages(): HasMany
    {
        return $this->hasMany(ProjectStage::class)->orderBy('sort_order');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'project_services')
            ->withPivot(['estimated_hours', 'agreed_price'])
            ->withTimestamps();
    }

    public function deliverables(): HasMany
    {
        return $this->hasMany(Deliverable::class);
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    public function overtimeRecords(): HasMany
    {
        return $this->hasMany(OvertimeRecord::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function extensions(): HasMany
    {
        return $this->hasMany(ProjectExtension::class);
    }

    public function riskPredictions(): HasMany
    {
        return $this->hasMany(AIRiskPrediction::class)->latest('evaluated_at');
    }

    public function calculateLaborCost(): float
    {
        return (float) $this->timesheets()->where('status', 'approved')->sum('labor_cost');
    }

    public function calculateOvertimeCost(): float
    {
        return (float) $this->overtimeRecords()->where('status', 'approved')->sum('overtime_cost');
    }

    public function calculateDirectExpenses(): float
    {
        return (float) $this->expenses()->where('status', 'approved')->sum('amount');
    }

    /**
     * Calculate expected profit from the project budget and selected service costs.
     *
     * @param  array<int, int|string>  $serviceIds
     */
    public static function calculateExpectedProfitForServices(float|int|string $budget, array $serviceIds): float
    {
        $serviceCost = Service::query()
            ->whereKey($serviceIds)
            ->sum('estimated_cost');

        return round((float) $budget - (float) $serviceCost, 2);
    }

    public function calculateTotalCost(): float
    {
        return $this->calculateLaborCost() + $this->calculateOvertimeCost() + $this->calculateDirectExpenses();
    }

    public function calculateInvoicedRevenue(): float
    {
        return (float) $this->invoices()->whereIn('status', ['paid', 'partially_paid', 'sent'])->sum('total');
    }

    public function calculateCollectedRevenue(): float
    {
        return (float) $this->invoices()->sum('amount_paid');
    }

    public function calculateGrossProfit(): float
    {
        $revenue = $this->calculateInvoicedRevenue();
        $costs = $this->calculateTotalCost();

        return $revenue > 0 ? ($revenue - $costs) : ($this->budget - $costs);
    }

    public function calculateMarginPercentage(): float
    {
        $base = $this->calculateInvoicedRevenue() ?: (float) $this->budget;

        if ($base <= 0) {
            return 0.0;
        }

        return round(($this->calculateGrossProfit() / $base) * 100, 2);
    }

    public function calculateHealthScore(): float
    {
        $totalTasks = $this->tasks()->count();
        $completedTasks = $this->tasks()->whereIn('status', ['completed', 'done'])->count();
        $overdueTasks = $this->tasks()
            ->whereNotIn('status', ['completed', 'done'])
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', now()->toDateString())
            ->count();
        $scheduleScore = $totalTasks === 0
            ? 100
            : max(0, (($completedTasks / $totalTasks) * 100) - (($overdueTasks / $totalTasks) * 30));

        $budget = (float) $this->budget;
        $budgetUsage = $budget > 0 ? ($this->calculateTotalCost() / $budget) * 100 : 0;
        $budgetScore = $budget <= 0 ? 100 : max(0, 100 - max(0, $budgetUsage - 80) * 5);

        $outstandingRisks = $this->riskPredictions()
            ->where(function ($query): void {
                $query->whereIn('risk_level', ['high', 'critical'])
                    ->orWhere('probability_score', '>=', 60);
            })
            ->count();
        $riskScore = max(0, 100 - ($outstandingRisks * 20));

        $totalStages = $this->stages()->count();
        $delayedStages = $this->stages()
            ->whereNotIn('status', ['completed', 'done'])
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', now()->toDateString())
            ->count();
        $stageScore = $totalStages === 0
            ? 100
            : max(0, 100 - (($delayedStages / $totalStages) * 100));

        $approvalCounts = ClientApproval::query()
            ->whereHas('deliverable', fn ($query) => $query->where('project_id', $this->id))
            ->selectRaw("sum(case when decision in ('approved', 'accepted') then 1 else 0 end) as positive")
            ->selectRaw("sum(case when decision in ('rejected', 'changes_requested') then 1 else 0 end) as negative")
            ->first();
        $positiveApprovals = (int) ($approvalCounts?->positive ?? 0);
        $negativeApprovals = (int) ($approvalCounts?->negative ?? 0);
        $decidedApprovals = $positiveApprovals + $negativeApprovals;
        $satisfactionScore = $decidedApprovals === 0
            ? 75
            : ($positiveApprovals / $decidedApprovals) * 100;

        $activeTasks = $this->tasks()->whereNotIn('status', ['completed', 'done'])->count();
        $assignedEmployees = $this->tasks()
            ->whereNotIn('status', ['completed', 'done'])
            ->whereNotNull('assigned_to')
            ->distinct('assigned_to')
            ->count('assigned_to');
        $averageActiveTasks = $assignedEmployees > 0 ? $activeTasks / $assignedEmployees : 0;
        $workloadScore = max(0, 100 - max(0, $averageActiveTasks - 2) * 16.67);

        $blockedTasks = $this->tasks()->where('status', 'blocked')->count();
        $rejectedApprovals = $negativeApprovals;
        $openIssuesScore = max(0, 100 - (($blockedTasks * 25) + ($rejectedApprovals * 15)));

        return round(
            ($scheduleScore * 0.20)
            + ($budgetScore * 0.20)
            + ($riskScore * 0.15)
            + ($stageScore * 0.15)
            + ($satisfactionScore * 0.15)
            + ($workloadScore * 0.10)
            + ($openIssuesScore * 0.05),
            2,
        );
    }

    public function recalculateHealthScore(): void
    {
        $this->updateQuietly([
            'health_score' => $this->calculateHealthScore(),
        ]);
    }

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->project_code)) {
                $latestId = self::max('id') ?? 0;
                $nextId = $latestId + 1;

                // Example format: QUT-2026-0001
                $project->project_code = 'PRJ-'.date('Y').'-'.str_pad($nextId, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
