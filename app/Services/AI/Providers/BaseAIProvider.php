<?php

namespace App\Services\AI\Providers;

use App\Models\Project;
use App\Services\AI\Contracts\AIProviderInterface;

abstract class BaseAIProvider implements AIProviderInterface
{
    public function __construct(
        protected ?string $apiKey = null,
        protected string $model = 'default',
        protected float $temperature = 0.7,
        protected int $maxTokens = 2048,
    ) {}

    public function predictProjectRisk(Project $project): array
    {
        $totalCost = $project->calculateTotalCost();
        $budget = (float) $project->budget;
        $budgetBurnRatio = $budget > 0 ? ($totalCost / $budget) : 0;

        $riskLevel = 'low';
        $probability = 15.0;
        $recommendations = ['Project budget and timeline are currently within optimal healthy thresholds.'];

        if ($budgetBurnRatio >= 0.95) {
            $riskLevel = 'critical';
            $probability = 92.0;
            $recommendations = [
                'Budget threshold exceeded 95%. Freeze unapproved overtime immediately.',
                'Initiate formal scope change order with the client for additional billable hours.',
                'Schedule emergency project review with account director.',
            ];
        } elseif ($budgetBurnRatio >= 0.80) {
            $riskLevel = 'high';
            $probability = 75.0;
            $recommendations = [
                'Budget burn is approaching 80%. Review upcoming stage resource allocations.',
                'Verify deliverable revision counts against contract terms.',
            ];
        } elseif ($budgetBurnRatio >= 0.65) {
            $riskLevel = 'medium';
            $probability = 45.0;
            $recommendations = [
                'Monitor overtime logging closely for upcoming design sprints.',
            ];
        }

        return [
            'risk_level' => $riskLevel,
            'probability_score' => $probability,
            'recommendations' => $recommendations,
        ];
    }

    public function calculateHealthScore(Project $project): array
    {
        $budget = (float) $project->budget;
        $cost = $project->calculateTotalCost();
        $budgetScore = 100.0;

        if ($budget > 0) {
            $ratio = $cost / $budget;
            $budgetScore = max(0.0, min(100.0, 100.0 - ($ratio > 0.8 ? ($ratio - 0.8) * 200 : 0)));
        }

        $stagesCount = $project->stages()->count();
        $completedStages = $project->stages()->where('status', 'completed')->count();
        $timelineScore = $stagesCount > 0 ? round(($completedStages / $stagesCount) * 100, 2) : 90.0;

        $pendingExtensions = $project->extensions()->where('status', 'pending')->count();
        $approvalScore = max(20.0, 100.0 - ($pendingExtensions * 25.0));

        $compositeScore = round(
            ($budgetScore * 0.40) + ($timelineScore * 0.35) + ($approvalScore * 0.25),
            2
        );

        return [
            'score' => $compositeScore,
            'factors' => [
                'budget_health' => round($budgetScore, 1),
                'timeline_progress' => round($timelineScore, 1),
                'approval_velocity' => round($approvalScore, 1),
            ],
            'summary' => $compositeScore >= 80 ? 'Excellent condition' : ($compositeScore >= 60 ? 'Moderate concern' : 'Requires immediate attention'),
        ];
    }

    public function detectScopeCreep(Project $project, string $clientFeedback): array
    {
        $keywords = ['also', 'extra', 'additional', 'new feature', 'different concept', 're-design', 'major change', 'expand', 'more options'];
        $feedbackLower = strtolower($clientFeedback);

        $detected = [];
        foreach ($keywords as $word) {
            if (str_contains($feedbackLower, $word)) {
                $detected[] = "Flagged request element: '{$word}'";
            }
        }

        $hasScopeChange = count($detected) > 0;
        $severity = count($detected) >= 3 ? 'high' : ($hasScopeChange ? 'medium' : 'low');

        return [
            'has_scope_change' => $hasScopeChange,
            'severity' => $severity,
            'detected_items' => $detected ?: ['No immediate scope deviation detected.'],
            'suggested_cost' => $hasScopeChange ? 1500.00 : 0.0,
        ];
    }

    public function generateProposal(array $briefData): array
    {
        $title = $briefData['title'] ?? 'Strategic Creative Engagement';
        $services = $briefData['services'] ?? ['Brand Strategy', 'Visual Identity'];

        return [
            'title' => "Executive Creative Proposal: {$title}",
            'executive_summary' => 'AgencyFlow AI proposal crafted for modern brand transformation, uniting strategic vision with world-class design execution.',
            'scope' => $services,
            'timeline_weeks' => 8,
            'estimated_investment' => (float) ($briefData['budget'] ?? 25000.00),
        ];
    }

    public function calculateContentCost(array $contentSpecs): array
    {
        $deliverableType = $contentSpecs['type'] ?? 'social_post';
        $quantity = (int) ($contentSpecs['quantity'] ?? 1);

        $unitHours = match ($deliverableType) {
            'video_production' => 16.0,
            '3d_visualization' => 12.0,
            'animation' => 10.0,
            'campaign_copywriting' => 4.0,
            default => 2.0,
        };

        $totalHours = $unitHours * $quantity;
        $laborCost = $totalHours * 75.00;
        $productionCost = match ($deliverableType) {
            'video_production' => 1200.00,
            '3d_visualization' => 500.00,
            default => 100.00,
        };

        $totalCost = $laborCost + $productionCost;
        $suggestedPrice = round($totalCost * 1.50, 2);

        return [
            'estimated_hours' => $totalHours,
            'labor_cost' => $laborCost,
            'production_cost' => $productionCost,
            'total_cost' => $totalCost,
            'suggested_price' => $suggestedPrice,
        ];
    }
}
