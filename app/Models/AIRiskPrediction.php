<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AIRiskPrediction extends Model
{
    use HasFactory;

    protected $table = 'ai_risk_predictions';

    protected $fillable = [
        'project_id',
        'risk_type',
        'risk_level',
        'probability_score',
        'recommendations',
        'evaluated_at',
    ];

    protected function casts(): array
    {
        return [
            'probability_score' => 'decimal:2',
            'recommendations' => 'array',
            'evaluated_at' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
