<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'project_id',
        'stage_id',
        'task_id',
        'date',
        'hours',
        'labor_cost',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'hours' => 'decimal:2',
            'labor_cost' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Timesheet $timesheet) {
            if ($timesheet->employee_id && (! $timesheet->labor_cost || $timesheet->isDirty('hours'))) {
                $employee = $timesheet->employee ?: Employee::find($timesheet->employee_id);
                if ($employee) {
                    $timesheet->labor_cost = round((float) $timesheet->hours * (float) $employee->hourly_rate, 2);
                }
            }
        });
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(ProjectStage::class, 'stage_id');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
