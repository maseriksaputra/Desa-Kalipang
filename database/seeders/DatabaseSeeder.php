<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@kalipang.desa.id',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Membuat Akun User Biasa (untuk testing)
        User::create([
            'name' => 'Warga Kalipang',
            'email' => 'warga@kalipang.desa.id',
            'password' => bcrypt('warga123'),
            'role' => 'user',
        ]);
    }
}
