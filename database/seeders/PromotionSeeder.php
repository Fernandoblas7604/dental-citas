<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        Promotion::updateOrCreate(
            ['title' => 'Promoción de primera consulta'],
            [
                'description' => 'Consulta inicial promocional.',
                'discount_percentage' => 10,
                'starts_at' => now()->toDateString(),
                'ends_at' => now()->addMonth()->toDateString(),
                'active' => true,
            ]
        );
    }
}