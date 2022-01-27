<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect([
            ['name' => 'Animals', 'thumbnail' => 'category/animals.png'],
            ['name' => 'Architecture', 'thumbnail' => 'category/architecture.jpg'],
            ['name' => 'Character', 'thumbnail' => 'category/character.jpeg'],
            ['name' => 'Electronics', 'thumbnail' => 'category/electronics.jpg'],
            ['name' => 'Furniture', 'thumbnail' => 'category/furniture.jpg'],
            ['name' => 'Plants', 'thumbnail' => 'category/plants.jpg'],
            ['name' => 'Tools', 'thumbnail' => 'category/tools.jpg'],
            ['name' => 'Vehicle', 'thumbnail' => 'category/vehicle.jpg'],
            ['name' => 'Weapons', 'thumbnail' => 'category/weapon.jpeg'],
        ]);
        foreach ($categories as $item) {
            Category::create([
                'name' => $item['name'],
                'thumbnail' => $item['thumbnail'],
                'slug' => \Str::slug($item['name'])
            ]);
        }
    }
}
