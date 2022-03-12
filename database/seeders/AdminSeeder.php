<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'william',
            'last_name' => 'galas',
            'middle_name' => 'salunson',
            'user_name' => 'it_admin',
            'gender' => User::GENDER_MALE,
            'sex' => User::GENDER_MALE,
            'address' => 'Guevara, La Paz, Tarlac',
            'country' => 'Philippines',
            'city' => 'Tarlac',
            'role' => User::ROLE_ADMIN,
            'birth_date' => '2000-03-04',
            'email' => 'william@admin.com',
            'account_type' => ROLE::SUPERADMIN,
            'password' => bcrypt('password'),
        ]);
    }
}
