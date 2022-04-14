<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bulletins = [
            '3*100',
            '7*180',
            '30*750',
        ];
        $marquees = [
            '7*120',
            '30*510',
        ];
        $slidingBanner = [
            '3*300',
            '7*600',
            '30*2400',
        ];
        $messageBlast = [
            '1*100',
            '3*420',
        ];
        $loadingImage = [
            '3*100',
            '7*600',
            '30*2400',
        ];
        $newspaper = [
            '3*100',
            '7*180',
            '30*750',
        ];

        $packages = [ $bulletins, $marquees, $slidingBanner, $messageBlast, $loadingImage, $newspaper];
        $keys = [Package::TYPE_BULLETIN, Package::TYPE_MARQUEE, Package::TYPE_SLIDING_BANNER, Package::TYPE_MESSAGE_BLAST, Package::TYPE_LOADING_IMAGE, Package::TYPE_NEWSPAPER];
        foreach ($packages as $key => $package) {
            foreach ($package as $value) {
                [$days, $cost] = explode('*', $value);
                Package::create([
                    'type' => $keys[$key],
                    'number_of_days' => $days,
                    'cost' => $cost,
                ]);
            }
        }
    }
}
