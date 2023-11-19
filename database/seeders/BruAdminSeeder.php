<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class BruAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Khiara',
            'last_name' => 'Pasion',
            'middle_name' => '',
            'user_name' => 'khiara_admin',
            'gender' => User::GENDER_FEMALE,
            'sex' => User::GENDER_FEMALE,
            'address' => 'Zone 4 Sitio Banaot, San Isidro',
            'country' => 'PH',
            'city' => 'Tarlac',
            'role' => User::ROLE_ADMIN,
            'birth_date' => '2000-03-04',
            'email' => 'khiara.laurea@brumultiverse.com',
            'account_type' => ROLE::SUPERADMIN,
            'password' => bcrypt('p@s$w0rd'),
        ]);
    }
}
