<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role'     => 'Admin',
        ]);

        // 2. Akun Operator
        User::create([
            'username' => 'operator',
            'password' => Hash::make('operator123'),
            'role'     => 'Operator',
        ]);
    }
}