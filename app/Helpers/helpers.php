<?php
use App\Helpers\AssetHelper;
if (! function_exists('getAsset')) {
    function getAsset($path, $local=false): string
    {
        return AssetHelper::get($path, $local);
    }
}
