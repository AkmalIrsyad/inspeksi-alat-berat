<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@example.com',
            'password' => Hash::make('password'),
            'role' => 'supervisor',
            'foto' => 'default.jpg'
        ]);

        User::create([
            'name' => 'Inspector',
            'email' => 'inspector@example.com',
            'password' => Hash::make('password'),
            'role' => 'inspector',
            'foto' => 'default.jpg'
        ]);
    }
}
