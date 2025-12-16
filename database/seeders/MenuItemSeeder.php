<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Cafeteria;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cafeteria = Cafeteria::first();
        $bebidasCalientes = Category::where('slug', 'bebidas-calientes')->first();
        $bebidasFrias = Category::where('slug', 'bebidas-frias')->first();
        $panaderia = Category::where('slug', 'panaderia')->first();
        $postres = Category::where('slug', 'postres')->first();

        $items = [
            // Bebidas Calientes
            [
                'cafeteria_id' => $cafeteria->id,
                'category_id' => $bebidasCalientes->id,
                'name' => 'Espresso Clásico',
                'description' => 'Espresso italiano elaborado con granos de café arábica premium',
                'price' => 2500,
                'is_available' => true,
                'preparation_time' => 3,
            ],
            [
                'cafeteria_id' => $cafeteria->id,
                'category_id' => $bebidasCalientes->id,
                'name' => 'Cappuccino Dorado',
                'description' => 'Cappuccino con espuma de leche decorada con polvo dorado comestible',
                'price' => 4500,
                'is_available' => true,
                'preparation_time' => 5,
            ],
            [
                'cafeteria_id' => $cafeteria->id,
                'category_id' => $bebidasCalientes->id,
                'name' => 'Latte Vainilla',
                'description' => 'Latte suave con jarabe de vainilla natural',
                'price' => 4000,
                'is_available' => true,
                'allergens' => ['lactosa'],
                'preparation_time' => 5,
            ],
            // Bebidas Frías
            [
                'cafeteria_id' => $cafeteria->id,
                'category_id' => $bebidasFrias->id,
                'name' => 'Frappé de Caramelo',
                'description' => 'Bebida helada con café, hielo y caramelo',
                'price' => 5500,
                'is_available' => true,
                'allergens' => ['lactosa'],
                'preparation_time' => 7,
            ],
            [
                'cafeteria_id' => $cafeteria->id,
                'category_id' => $bebidasFrias->id,
                'name' => 'Cold Brew',
                'description' => 'Café de extracción en frío durante 24 horas',
                'price' => 4500,
                'is_available' => true,
                'preparation_time' => 3,
            ],
            // Panadería
            [
                'cafeteria_id' => $cafeteria->id,
                'category_id' => $panaderia->id,
                'name' => 'Croissant de Mantequilla',
                'description' => 'Croissant artesanal francés hojaldrado',
                'price' => 2800,
                'is_available' => true,
                'allergens' => ['gluten', 'lactosa'],
                'preparation_time' => 2,
            ],
            [
                'cafeteria_id' => $cafeteria->id,
                'category_id' => $panaderia->id,
                'name' => 'Pan de Chocolate',
                'description' => 'Croissant relleno de chocolate belga',
                'price' => 3200,
                'is_available' => true,
                'allergens' => ['gluten', 'lactosa'],
                'preparation_time' => 2,
            ],
            // Postres
            [
                'cafeteria_id' => $cafeteria->id,
                'category_id' => $postres->id,
                'name' => 'Tarta de Zanahoria',
                'description' => 'Bizcocho de zanahoria con frosting de queso crema',
                'price' => 4500,
                'is_available' => true,
                'allergens' => ['gluten', 'lactosa', 'nueces'],
                'preparation_time' => 3,
            ],
            [
                'cafeteria_id' => $cafeteria->id,
                'category_id' => $postres->id,
                'name' => 'Brownie Premium',
                'description' => 'Brownie de chocolate con nueces y cobertura de chocolate',
                'price' => 3800,
                'is_available' => true,
                'allergens' => ['gluten', 'lactosa', 'nueces'],
                'preparation_time' => 3,
            ],
            [
                'cafeteria_id' => $cafeteria->id,
                'category_id' => $postres->id,
                'name' => 'Cheesecake de Frambuesa',
                'description' => 'Tarta de queso con coulis de frambuesa',
                'price' => 5200,
                'is_available' => true,
                'allergens' => ['gluten', 'lactosa'],
                'preparation_time' => 3,
            ],
        ];

        foreach ($items as $item) {
            MenuItem::create($item);
        }
    }
}
