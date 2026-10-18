<?php

namespace App\Services\AI\Contracts;

use App\Models\Project;

interface AIProviderInterface
{
    /**
     * @param  array<string, mixed>  $options
     */
    public function generateCompletion(string $prompt, array $options = []): string;

    /**
     * @return array{risk_level: string, probability_score: float, recommendations: array<string>}
     */
    public function predictProjectRisk(Project $project): array;

    /**
     * @return array{score: float, factors: array<string, float>, summary: string}
     */
    public function calculateHealthScore(Project $project): array;

    /**
     * @return array{has_scope_change: bool, severity: string, detected_items: array<string>, suggested_cost: float}
     */
    public function detectScopeCreep(Project $project, string $clientFeedback): array;

    /**
     * @param  array<string, mixed>  $briefData
     * @return array{title: string, executive_summary: string, scope: array<string>, timeline_weeks: int, estimated_investment: float}
     */
    public function generateProposal(array $briefData): array;

    /**
     * @param  array<string, mixed>  $contentSpecs
     * @return array{estimated_hours: float, labor_cost: float, production_cost: float, total_cost: float, suggested_price: float}
     */
    public function calculateContentCost(array $contentSpecs): array;
}
