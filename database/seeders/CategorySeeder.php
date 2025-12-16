<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bebidas Calientes',
                'slug' => 'bebidas-calientes',
                'description' => 'Cafés, tés y bebidas calientes',
                'icon' => '☕',
                'order' => 1,
            ],
            [
                'name' => 'Bebidas Frías',
                'slug' => 'bebidas-frias',
                'description' => 'Frappés, smoothies y bebidas heladas',
                'icon' => '🧃',
                'order' => 2,
            ],
            [
                'name' => 'Panadería',
                'slug' => 'panaderia',
                'description' => 'Panes, croissants y pastelería',
                'icon' => '🥐',
                'order' => 3,
            ],
            [
                'name' => 'Postres',
                'slug' => 'postres',
                'description' => 'Pasteles, galletas y dulces',
                'icon' => '🍰',
                'order' => 4,
            ],
            [
                'name' => 'Desayunos',
                'slug' => 'desayunos',
                'description' => 'Desayunos completos y saludables',
                'icon' => '🍳',
                'order' => 5,
            ],
            [
                'name' => 'Snacks',
                'slug' => 'snacks',
                'description' => 'Bocadillos y snacks rápidos',
                'icon' => '🥪',
                'order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
