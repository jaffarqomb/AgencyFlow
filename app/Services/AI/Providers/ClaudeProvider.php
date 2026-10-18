<?php

namespace App\Services\AI\Providers;

use Illuminate\Support\Facades\Http;

class ClaudeProvider extends BaseAIProvider
{
    public function generateCompletion(string $prompt, array $options = []): string
    {
        if (! $this->apiKey) {
            return "AI Analysis [Simulated Claude 3.5 Sonnet Response]: {$prompt}";
        }

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'anthropic-version' => '2023-06-01',
            'content-type' => 'application/json',
        ])
            ->timeout(30)
            ->post('https://api.anthropic.com/v1/messages', [
                'model' => $this->model ?: 'claude-3-5-sonnet-20241022',
                'max_tokens' => $this->maxTokens,
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

        if ($response->successful()) {
            return (string) $response->json('content.0.text');
        }

        return 'AI Response Generation Error: '.$response->body();
    }
}
