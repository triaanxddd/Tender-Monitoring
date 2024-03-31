<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@123'),
            'role' => 1
        ]);

        User::create([
            'name' => 'staf1',
            'email' => 'staf@gmail.com',
            'password' => bcrypt('staf@123'),
            'role' => 0
        ]);
    }
}
