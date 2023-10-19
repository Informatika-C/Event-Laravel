<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('katasandi'),
        ]);

        Admin::create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',  
            'password' => bcrypt('katasandi'),
        ]);
    }
}
