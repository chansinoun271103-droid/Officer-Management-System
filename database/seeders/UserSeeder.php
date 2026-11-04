<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name'     => 'Administrator',
                'password' => 'admin123',
                'role'     => 'admin',
            ]
        );

        User::updateOrCreate(
            ['username' => 'hr'],
            [
                'name'     => 'HR Manager',
                'password' => 'hr123456',
                'role'     => 'hr',
            ]
        );
    }
}