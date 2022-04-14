<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            CollegeAndClubSeeder::class,
            GenreAndLevelSeeder::class,
            GroupTypeSeeder::class,
            LanguageSeeder::class,
            PackageSeeder::class,
            UserSeeder::class,
            AvatarBaseSeeder::class,
            AvatarAssetSeeder::class,
        ]);
    }
}
