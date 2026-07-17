<?php

namespace App\Http\Controllers\Traits;

trait SanitizesData
{
    /**
     * Normalize and sanitize input values before persisting.
     *
     * @param  array  $data
     * @return array
     */
    protected function sanitizeData(array $data): array
    {
        return array_map(function ($value) {
            if (is_string($value)) {
                return trim(strip_tags($value));
            }

            return $value;
        }, $data);
    }
}
