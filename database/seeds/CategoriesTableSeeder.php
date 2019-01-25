<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::create([
        	'name' => 'Ao nam',
        	'slug' => 'ao-nam',
        	'description' => 'Ao nam',
        ]);
        Category::create([
        	'name' => 'Ao nu',
        	'slug' => 'ao-nu',
        	'description' => 'Ao nu',
        ]);
        Category::create([
        	'name' => 'Quan nam',
        	'slug' => 'quan-nam',
        	'description' => 'Quan nam',
        ]);
        Category::create([
        	'name' => 'Quan nu',
        	'slug' => 'quan-nu',
        	'description' => 'Quan nu',
        ]);
    }
}
