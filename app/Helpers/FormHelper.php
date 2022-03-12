<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class FormHelper {
    /**
     * @param mixed $keys
     *
     * @return array
     */
    public static function removeDataWithKeys($keys, $array): array
    {
        $keys = Collection::wrap($keys)->toArray();
        return collect($array)->filter(fn ($val, $key) => !in_array($key, $keys))->toArray();
    }
}
