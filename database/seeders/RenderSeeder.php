<?php

namespace Database\Seeders;

use App\Models\Render;
use Illuminate\Database\Seeder;

class RenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $renders = collect(['Cycle', 'EEVEE', 'Lumion', 'Workbench', 'Mental Ray', 'Iray', 'Octane Render', 'Maxwell Render', 'Arnold', 'Redshift']);

        foreach ($renders as $item) {
            Render::create(['name' => $item, 'slug' => \Str::slug($item)]);
        }
    }
}
