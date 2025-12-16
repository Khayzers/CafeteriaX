<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario Admin (Dueño)
        User::create([
            'name' => 'Admin',
            'email' => 'admin@cafeteriax.com',
            'password' => Hash::make('Admin123!'),
            'role' => 'dueño',
            'phone' => '+56 9 9000 0001',
        ]);

        // Usuario Cliente - Seba
        User::create([
            'name' => 'Seba Laytte',
            'email' => 'seba.laytte.v@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'cliente',
            'phone' => '+56 9 6000 0000',
        ]);

        // Usuario Cliente Demo
        User::create([
            'name' => 'Cliente Demo',
            'email' => 'cliente@test.com',
            'password' => Hash::make('password'),
            'role' => 'cliente',
        ]);

        // Usuario Dueño Demo
        User::create([
            'name' => 'Dueño Demo',
            'email' => 'dueno@test.com',
            'password' => Hash::make('password'),
            'role' => 'dueño',
        ]);
    }
}
