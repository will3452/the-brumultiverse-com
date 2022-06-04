<?php
use Illuminate\Support\Str;
use App\Helpers\AssetHelper;
if (! function_exists('getAsset')) {
    function getAsset($path, $local=false): string
    {
        return AssetHelper::get($path, $local);
    }
}

if (! function_exists('displayCost')) {
    function displayCost($value, $label) {
        if ($value == 0) {
            return "FREE";
        }

        // $result = number_format($value, 2);

        if ($value > 1) {
            return $value . " " . Str::plural($label);
        }

        return "$value $label";
    }
}
