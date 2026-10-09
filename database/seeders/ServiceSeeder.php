<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Limpieza dental',
                'description' => 'Servicio de limpieza dental.',
                'price' => 500,
                'duration_minutes' => 30,
            ],
            [
                'name' => 'Consulta general',
                'description' => 'Valoración odontológica inicial.',
                'price' => 350,
                'duration_minutes' => 30,
            ],
            [
                'name' => 'Blanqueamiento dental',
                'description' => 'Servicio sujeto a valoración.',
                'price' => 1800,
                'duration_minutes' => 60,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                $service + ['active' => true]
            );
        }
    }
}