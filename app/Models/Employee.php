<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'team_id',
        'employee_id',
        'full_name',
        'email',
        'mobile',
        'designation',
        'department',
        'hourly_rate',
        'overtime_rate',
        'joining_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'hourly_rate' => 'decimal:2',
            'overtime_rate' => 'decimal:2',
            'joining_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    public function overtimeRecords(): HasMany
    {
        return $this->hasMany(OvertimeRecord::class);
    }
}
