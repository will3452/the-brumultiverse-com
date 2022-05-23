<?php

namespace App\Nova\Traits;

trait MarketingTrait
{
    public function optionPackages()
    {
        $packages = \App\Models\Package::whereType(self::PACKAGE_TYPE)->get();

        $results = [];
        foreach ($packages as $package) {
            $cost = number_format($package->cost, 2);
            $results[$package->id] = "$package->number_of_days day(s) - $cost";
        }

        return $results;
    }
}
