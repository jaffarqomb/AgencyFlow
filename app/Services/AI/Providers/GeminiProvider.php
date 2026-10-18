<?php

namespace App\Services\AI\Providers;

use Illuminate\Support\Facades\Http;

class GeminiProvider extends BaseAIProvider
{
    public function generateCompletion(string $prompt, array $options = []): string
    {
        if (! $this->apiKey) {
            return "AI Analysis [Simulated Google Gemini 2.5 Flash Response]: {$prompt}";
        }

        $model = $this->model ?: 'gemini-2.5-flash';
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$this->apiKey}";

        $response = Http::timeout(30)
            ->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                        ],
                    ],
                ],
            ]);

        if ($response->successful()) {
            return (string) $response->json('candidates.0.content.parts.0.text');
        }

        return 'AI Response Generation Error: '.$response->body();
    }
}
