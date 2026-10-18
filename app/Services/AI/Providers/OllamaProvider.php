<?php

namespace App\Services\AI\Providers;

use Illuminate\Support\Facades\Http;

class OllamaProvider extends BaseAIProvider
{
    public function generateCompletion(string $prompt, array $options = []): string
    {
        $host = config('services.ollama.host', 'http://localhost:11434');

        $response = Http::timeout(60)
            ->post("{$host}/api/generate", [
                'model' => $this->model ?: 'llama3.1',
                'prompt' => $prompt,
                'stream' => false,
            ]);

        if ($response->successful()) {
            return (string) $response->json('response');
        }

        return 'AI Response Generation Error: '.$response->body();
    }
}
