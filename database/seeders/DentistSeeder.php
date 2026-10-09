<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DentistSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'dentista@example.com'],
            [
                'name' => 'Dentista',
                'password' => Hash::make(
                    env('DENTIST_INITIAL_PASSWORD', 'Cambiar-123!')
                ),
            ]
        );
    }
}