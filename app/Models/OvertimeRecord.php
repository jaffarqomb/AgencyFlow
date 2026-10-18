<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OvertimeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'project_id',
        'task_id',
        'date',
        'overtime_hours',
        'overtime_rate',
        'overtime_cost',
        'reason',
        'status',
        'approved_by',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'overtime_hours' => 'decimal:2',
            'overtime_rate' => 'decimal:2',
            'overtime_cost' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (OvertimeRecord $record) {
            if ($record->employee_id && (! $record->overtime_rate || $record->isDirty('employee_id'))) {
                $employee = $record->employee ?: Employee::find($record->employee_id);
                if ($employee && ! $record->overtime_rate) {
                    $record->overtime_rate = $employee->overtime_rate;
                }
            }

            if ($record->overtime_hours && $record->overtime_rate) {
                $record->overtime_cost = round((float) $record->overtime_hours * (float) $record->overtime_rate, 2);
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

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
