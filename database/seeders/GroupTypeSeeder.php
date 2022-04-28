<?php

namespace Database\Seeders;

use App\Models\GroupType;
use Illuminate\Database\Seeder;

class GroupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Band',
            'Film Crew',
            'Theater Troupe',
            'Collaborative Group',
            'Anthology Group',
        ];
        foreach ($types as $type) {
            GroupType::create(['description' => $type]);
        }
    }
}
