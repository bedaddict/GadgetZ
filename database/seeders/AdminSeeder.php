<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Khusus membuat akun Admin saja
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Email disamakan dengan yang kamu pakai login tadi
            [
                'name' => 'Admin Toko',
                'password' => Hash::make('password123'),
                'role' => 'Admin',
            ]
        );
    }
}