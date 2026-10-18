<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'category',
        'sort_order',
        'status',
        'start_date',
        'due_date',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'start_date' => 'date',
            'due_date' => 'date',
            'completed_at' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'stage_id');
    }

    public function deliverables(): HasMany
    {
        return $this->hasMany(Deliverable::class, 'stage_id');
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class, 'stage_id');
    }
}
