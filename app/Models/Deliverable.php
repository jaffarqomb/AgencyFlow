<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deliverable extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'stage_id',
        'title',
        'description',
        'current_status',
        'due_date',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
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

    public function versions(): HasMany
    {
        return $this->hasMany(DeliverableVersion::class)->orderByDesc('version_number');
    }

    public function latestVersion(): ?DeliverableVersion
    {
        return $this->versions()->first();
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(ClientApproval::class);
    }
}
