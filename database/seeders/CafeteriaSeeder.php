<?php

namespace Database\Seeders;

use App\Models\Cafeteria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CafeteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dueno = User::where('email', 'dueno@test.com')->first();

        $cafeterias = [
            [
                'user_id' => $dueno->id,
                'name' => 'Café Elegance',
                'description' => 'Cafetería premium con ambiente elegante y sofisticado. Especialidad en cafés de autor y repostería artesanal.',
                'phone' => '+56 2 2345 6789',
                'email' => 'info@cafeelegance.cl',
                'address' => 'Av. Providencia 1234',
                'latitude' => -33.4489,
                'longitude' => -70.6693,
                'city' => 'Santiago',
                'state' => 'Región Metropolitana',
                'opening_hours' => [
                    'lunes' => '8:00 - 20:00',
                    'martes' => '8:00 - 20:00',
                    'miércoles' => '8:00 - 20:00',
                    'jueves' => '8:00 - 20:00',
                    'viernes' => '8:00 - 22:00',
                    'sábado' => '9:00 - 22:00',
                    'domingo' => '9:00 - 18:00',
                ],
                'is_active' => true,
            ],
            [
                'user_id' => $dueno->id,
                'name' => 'Golden Coffee House',
                'description' => 'Experiencia única en café de especialidad. Ambiente acogedor con toques dorados y modernos.',
                'phone' => '+56 2 2567 8901',
                'email' => 'contacto@goldencoffee.cl',
                'address' => 'Av. Las Condes 5678',
                'latitude' => -33.4172,
                'longitude' => -70.5847,
                'city' => 'Santiago',
                'state' => 'Región Metropolitana',
                'opening_hours' => [
                    'lunes' => '7:00 - 21:00',
                    'martes' => '7:00 - 21:00',
                    'miércoles' => '7:00 - 21:00',
                    'jueves' => '7:00 - 21:00',
                    'viernes' => '7:00 - 23:00',
                    'sábado' => '8:00 - 23:00',
                    'domingo' => '8:00 - 20:00',
                ],
                'is_active' => true,
            ],
            [
                'user_id' => $dueno->id,
                'name' => 'Black & White Café',
                'description' => 'Diseño minimalista con contraste elegante. Perfecta combinación de tradición y modernidad.',
                'phone' => '+56 2 2876 5432',
                'email' => 'hola@blackwhitecafe.cl',
                'address' => 'Av. Vitacura 9876',
                'latitude' => -33.4003,
                'longitude' => -70.5746,
                'city' => 'Santiago',
                'state' => 'Región Metropolitana',
                'opening_hours' => [
                    'lunes' => '8:00 - 19:00',
                    'martes' => '8:00 - 19:00',
                    'miércoles' => '8:00 - 19:00',
                    'jueves' => '8:00 - 19:00',
                    'viernes' => '8:00 - 20:00',
                    'sábado' => '9:00 - 20:00',
                    'domingo' => 'Cerrado',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($cafeterias as $cafeteria) {
            Cafeteria::create($cafeteria);
        }
    }
}
