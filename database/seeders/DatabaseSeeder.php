<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'sandeep198558@gmail.com'],
            [
                'name' => 'Sandeep Rathod',
                'mobile' => '9664588677',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'leenaadam28@gmail.com'],
            [
                'name' => 'Leena Adam',
                'mobile' => '9769409405',
                'password' => Hash::make('password'),
            ]
        );
    }
}
