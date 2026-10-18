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
}
