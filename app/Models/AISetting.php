<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AISetting extends Model
{
    use HasFactory;

    protected $table = 'ai_settings';

    protected $fillable = [
        'provider',
        'api_key',
        'model_name',
        'is_active',
        'temperature',
        'max_tokens',
        'monthly_budget_usd',
        'total_spent_usd',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'temperature' => 'decimal:2',
            'max_tokens' => 'integer',
            'monthly_budget_usd' => 'decimal:2',
            'total_spent_usd' => 'decimal:2',
        ];
    }
}
