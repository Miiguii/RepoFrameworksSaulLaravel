<?php

namespace App\Rules;

use App\Services\RenapoService;
use Illuminate\Contracts\Validation\Rule;

class Curp implements Rule
{
    protected string $message = 'El CURP proporcionado no es válido.';

    public function passes($attribute, $value): bool
    {
        $curp = strtoupper(trim((string) $value));

        if (!preg_match('/^[A-ZÑ&]{4}[0-9]{6}[HM][A-Z]{5}[0-9]{2}$/', $curp)) {
            return false;
        }

        if (empty(config('services.renapo.base_uri'))) {
            return true;
        }

        $service = RenapoService::fromConfig();
        $valid = $service->verifyCurp($curp);

        if (! $valid) {
            $this->message = 'El CURP no pudo validarse contra la API de RENAPO.';
        }

        return $valid;
    }

    public function message(): string
    {
        return $this->message;
    }
}
