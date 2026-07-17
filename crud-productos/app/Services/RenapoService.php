<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class RenapoService
{
    public function __construct(
        protected string $baseUri,
        protected ?string $apiKey,
    ) {
        $this->baseUri = rtrim($this->baseUri, '/');
    }

    public static function fromConfig(): self
    {
        return new self(
            config('services.renapo.base_uri', ''),
            config('services.renapo.api_key', null),
        );
    }

    public function verifyCurp(string $curp): bool
    {
        if (empty($this->baseUri)) {
            return false;
        }

        try {
            $response = Http::withHeaders($this->defaultHeaders())
                ->timeout(10)
                ->get($this->baseUri.'/curp', ['curp' => $curp]);

            if (! $response->successful()) {
                return false;
            }

            $data = $response->json();
            return isset($data['curp']) && strtoupper($data['curp']) === $curp;
        } catch (Exception) {
            return false;
        }
    }

    public function fetchPersonByCurp(string $curp): ?array
    {
        if (empty($this->baseUri)) {
            return null;
        }

        try {
            $response = Http::withHeaders($this->defaultHeaders())
                ->timeout(10)
                ->get($this->baseUri.'/curp', ['curp' => $curp]);

            if (! $response->successful()) {
                return null;
            }

            return $response->json();
        } catch (Exception) {
            return null;
        }
    }

    protected function defaultHeaders(): array
    {
        $headers = ['Accept' => 'application/json'];

        if (! empty($this->apiKey)) {
            $headers['Authorization'] = 'Bearer '.$this->apiKey;
        }

        return $headers;
    }
}
