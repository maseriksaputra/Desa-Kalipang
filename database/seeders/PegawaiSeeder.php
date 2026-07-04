<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Budi Infrastruktur',
            'email' => 'infrastruktur@desa.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'pegawai',
            'department' => 'Infrastruktur',
        ]);

        \App\Models\User::create([
            'name' => 'Siti Sosial',
            'email' => 'sosial@desa.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'pegawai',
            'department' => 'Sosial',
        ]);
    }
}
