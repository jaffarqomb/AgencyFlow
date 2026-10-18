<?php

namespace App\Services\AI\Providers;

use Illuminate\Support\Facades\Http;

class OpenAIProvider extends BaseAIProvider
{
    public function generateCompletion(string $prompt, array $options = []): string
    {
        if (! $this->apiKey) {
            return "AI Analysis [Simulated OpenAI Response]: {$prompt}";
        }

        $response = Http::withToken($this->apiKey)
            ->timeout(30)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => $this->model ?: 'gpt-4o',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are AgencyFlow AI, an enterprise agency ERP reasoning engine.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => $this->temperature,
                'max_tokens' => $this->maxTokens,
            ]);

        if ($response->successful()) {
            return (string) $response->json('choices.0.message.content');
        }

        return 'AI Response Generation Error: '.$response->body();
    }
}
