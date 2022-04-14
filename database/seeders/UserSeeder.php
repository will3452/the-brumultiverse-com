<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "first_name" => "Khiara",
                "last_name" => "Pasion",
                "password" => "$2y$10$3qkSwzJ7i.2RXr8BNWLHsOQhYXtbNveUSJcddrr/6rdKmNi5E8IkK",
                "middle_name" => null,
                "user_name" => "Khiara-Pasion-iTa8yH",
                "gender" => "Female",
                "birth_date" => "1987-03-30T16:00:00.000000Z",
                "sex" => "Female",
                "address" => "Tarlac City",
                "country" => "PH",
                "city" => "Tarlac City",
                "picture" => "bru-large-file62557f6ccad571649770348.jpg",
                "account_type" => "Free",
                "role" => "Author",
                "email" => "kzriman@gmail.com",
                "email_verified_at" => "2022-04-12T05:53:42.000000Z",
                "last_login_at" => "2022-04-14T01:22:46.000000Z",
            ],
            [
                "first_name" => "William",
                "last_name" => "Galas",
                "password" => "$2y$10$3qkSwzJ7i.2RXr8BNWLHsOQhYXtbNveUSJcddrr/6rdKmNi5E8IkK",
                "middle_name" => null,
                "user_name" => "William-Galas-iTa8yH",
                "gender" => "Male",
                "birth_date" => "1987-03-30T16:00:00.000000Z",
                "sex" => "Male",
                "address" => "Tarlac City",
                "country" => "PH",
                "city" => "Tarlac City",
                "picture" => "bru-large-file62557f6ccad571649770348.jpg",
                "account_type" => "Free",
                "role" => "Author",
                "email" => "williamgalas03@gmail.com",
                "email_verified_at" => "2022-04-12T05:53:42.000000Z",
                "last_login_at" => "2022-04-14T01:22:46.000000Z",
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
