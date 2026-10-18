<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectExtension extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'stage_id',
        'requested_by',
        'current_deadline',
        'new_deadline',
        'reason',
        'extra_hours',
        'extra_cost',
        'status',
        'rejection_reason',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'current_deadline' => 'date',
            'new_deadline' => 'date',
            'extra_hours' => 'decimal:2',
            'extra_cost' => 'decimal:2',
            'approved_at' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(ProjectStage::class, 'stage_id');
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approve(): void
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        if ($this->project && $this->new_deadline) {
            $this->project->update([
                'planned_end_date' => $this->new_deadline,
            ]);
        }

        if ($this->stage && $this->new_deadline) {
            $this->stage->update([
                'due_date' => $this->new_deadline,
            ]);
        }

        if ($this->extra_cost > 0) {
            Expense::create([
                'project_id' => $this->project_id,
                'category' => 'administration',
                'amount' => $this->extra_cost,
                'expense_date' => now()->toDateString(),
                'notes' => 'Extension approval extra cost: '.$this->reason,
                'status' => 'approved',
            ]);
        }
    }
}
