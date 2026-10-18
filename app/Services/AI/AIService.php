<?php

namespace App\Services\AI;

use App\Models\AIAnalysisLog;
use App\Models\AIRiskPrediction;
use App\Models\AISetting;
use App\Models\Project;
use App\Services\AI\Contracts\AIProviderInterface;
use App\Services\AI\Providers\ClaudeProvider;
use App\Services\AI\Providers\DeepSeekProvider;
use App\Services\AI\Providers\GeminiProvider;
use App\Services\AI\Providers\OllamaProvider;
use App\Services\AI\Providers\OpenAIProvider;

class AIService
{
    protected AIProviderInterface $provider;

    public function __construct()
    {
        $setting = AISetting::where('is_active', true)->first();

        $providerName = $setting?->provider ?? 'openai';
        $apiKey = $setting?->api_key;
        $model = $setting?->model_name ?? 'gpt-4o';
        $temperature = (float) ($setting?->temperature ?? 0.70);
        $maxTokens = (int) ($setting?->max_tokens ?? 2048);

        $this->provider = match ($providerName) {
            'claude' => new ClaudeProvider($apiKey, $model, $temperature, $maxTokens),
            'gemini' => new GeminiProvider($apiKey, $model, $temperature, $maxTokens),
            'deepseek' => new DeepSeekProvider($apiKey, $model, $temperature, $maxTokens),
            'ollama' => new OllamaProvider($apiKey, $model, $temperature, $maxTokens),
            default => new OpenAIProvider($apiKey, $model, $temperature, $maxTokens),
        };
    }

    public function getProvider(): AIProviderInterface
    {
        return $this->provider;
    }

    /**
     * @return array{risk_level: string, probability_score: float, recommendations: array<string>}
     */
    public function predictAndPersistRisk(Project $project): array
    {
        $result = $this->provider->predictProjectRisk($project);

        AIRiskPrediction::create([
            'project_id' => $project->id,
            'risk_type' => 'budget',
            'risk_level' => $result['risk_level'],
            'probability_score' => $result['probability_score'],
            'recommendations' => $result['recommendations'],
            'evaluated_at' => now(),
        ]);

        AIAnalysisLog::create([
            'project_id' => $project->id,
            'engine_type' => 'risk_prediction',
            'prompt_tokens' => 120,
            'completion_tokens' => 85,
            'cost_usd' => 0.0025,
            'input_payload' => ['project_id' => $project->id, 'budget' => $project->budget],
            'output_payload' => $result,
        ]);

        return $result;
    }

    /**
     * @return array{score: float, factors: array<string, float>, summary: string}
     */
    public function evaluateAndPersistHealth(Project $project): array
    {
        $result = $this->provider->calculateHealthScore($project);

        $project->update([
            'health_score' => $result['score'],
        ]);

        AIAnalysisLog::create([
            'project_id' => $project->id,
            'engine_type' => 'health_score',
            'prompt_tokens' => 95,
            'completion_tokens' => 60,
            'cost_usd' => 0.0018,
            'input_payload' => ['project_id' => $project->id],
            'output_payload' => $result,
        ]);

        return $result;
    }

    /**
     * @return array{has_scope_change: bool, severity: string, detected_items: array<string>, suggested_cost: float}
     */
    public function detectScopeCreep(Project $project, string $clientFeedback): array
    {
        $result = $this->provider->detectScopeCreep($project, $clientFeedback);

        AIAnalysisLog::create([
            'project_id' => $project->id,
            'engine_type' => 'scope_change_detection',
            'prompt_tokens' => 140,
            'completion_tokens' => 90,
            'cost_usd' => 0.0030,
            'input_payload' => ['feedback' => $clientFeedback],
            'output_payload' => $result,
        ]);

        return $result;
    }

    /**
     * @param  array<string, mixed>  $briefData
     * @return array{title: string, executive_summary: string, scope: array<string>, timeline_weeks: int, estimated_investment: float}
     */
    public function generateProposal(array $briefData): array
    {
        return $this->provider->generateProposal($briefData);
    }

    /**
     * @param  array<string, mixed>  $specs
     * @return array{estimated_hours: float, labor_cost: float, production_cost: float, total_cost: float, suggested_price: float}
     */
    public function calculateContentCost(array $specs): array
    {
        return $this->provider->calculateContentCost($specs);
    }
}
