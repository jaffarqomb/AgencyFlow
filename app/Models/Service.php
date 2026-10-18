<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'estimated_hours',
        'estimated_cost',
        'estimated_duration',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'estimated_hours' => 'decimal:2',
            'estimated_cost' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_services')
            ->withPivot(['estimated_hours', 'agreed_price'])
            ->withTimestamps();
    }
}
