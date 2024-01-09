<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Comida Italiana'],
            ['name' => 'Comida Mexicana'],
            ['name' => 'Comida Colombiana'],
            ['name' => 'Comida Argentina'],
            ['name' => 'Comida Peruana'],
            ['name' => 'Comida Española'],
        ];

        collect($categories)->each(fn ($category) => Category::create($category));
    }
}
