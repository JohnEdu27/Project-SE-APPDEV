<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/** Talks to the FastAPI NLP service. Returns null if it is down, so complaints still get saved. */
class ComplaintClassifier
{
    private function client(int $timeout)
    {
        return Http::baseUrl(config('services.nlp.url'))
            ->withHeaders(['X-API-Key' => (string) config('services.nlp.key')])
            ->acceptJson()
            ->timeout($timeout);
    }

    public function classify(string $text): ?array
    {
        try {
            $res = $this->client(5)->post('/classify', ['text' => $text]);
            return $res->successful() ? $res->json() : null;
        } catch (Throwable $e) {
            Log::warning('NLP service unavailable: ' . $e->getMessage());
            return null;
        }
    }

    public function retrain(array $examples): ?array
    {
        $res = $this->client(60)->post('/retrain', ['examples' => $examples]);
        return $res->successful() ? $res->json() : null;
    }
}
