<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AIAnalysisLog extends Model
{
    use HasFactory;

    protected $table = 'ai_analysis_logs';

    protected $fillable = [
        'project_id',
        'engine_type',
        'prompt_tokens',
        'completion_tokens',
        'cost_usd',
        'input_payload',
        'output_payload',
    ];

    protected function casts(): array
    {
        return [
            'prompt_tokens' => 'integer',
            'completion_tokens' => 'integer',
            'cost_usd' => 'decimal:4',
            'input_payload' => 'array',
            'output_payload' => 'array',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
