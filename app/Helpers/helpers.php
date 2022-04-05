<?php
use App\Helpers\AssetHelper;
if (! function_exists('getAsset')) {
    function getAsset($path): string
    {
        return AssetHelper::get($path);
    }
}
