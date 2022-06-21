<?php
use Illuminate\Support\Str;
use App\Helpers\AssetHelper;
if (! function_exists('getAsset')) {
    function getAsset($path, $local=false): string
    {
        return AssetHelper::get($path, $local);
    }
}

if (! function_exists('getBaseModel')) {
    function getBaseModel($modelPath): string
    {
        $arr = explode("\\", $modelPath);

        return end($arr);
    }
}

if (! function_exists('getFullModel')) {
    function getFullModel($model) {
        return "App\\Models\\$model";
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

if ( ! function_exists('compressCurrencyFormat')) {
    function compressCurrencyFormat ($value) {
        if ( $value >= 100_000_000) {
            return ($value / 100_000_000) . 'M';
        }

        if ( $value >= 1_000)
        {
            return ($value / 1_000) . 'K';
        }

        return $value;
    }
}
