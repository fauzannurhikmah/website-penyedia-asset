<?php

namespace Database\Seeders;

use App\Models\Software;
use Illuminate\Database\Seeder;

class SoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $software = collect(['3ds Max', 'Autodesk Maya', 'Blender', 'Cinema 4D', 'Daz Studio']);
        foreach ($software as $item) {
            Software::create(['name' => $item, 'slug' => \Str::slug($item)]);
        }
    }
}
