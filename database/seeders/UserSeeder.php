<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'npm' => '1234567890',
            'phone' => '081234567890'
        ]);

        User::create([
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('password'),
            'npm' => '1234567891',
            'phone' => '081234567891'
        ]);

        for ($i = 3; $i <= 20; $i++) {
            User::create([
                'name' => "User{$i}",
                'email' => "user{$i}@gmail.com",
                'password' => bcrypt('password'),
                'npm' => '123456789' . $i,
                'phone' => '08123456789' . $i
            ]);
        }
    }
}