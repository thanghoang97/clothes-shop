<?php

use Illuminate\Database\Seeder;
use App\Size;
class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::truncate();

        Size::create([
        	'name' => 'XS',
        	'description' => 'xs',
        ]);
        Size::create([
        	'name' => 'S',
        	'description' => 's',
        ]);
        Size::create([
        	'name' => 'M',
        	'description' => 'm',
        ]);
        Size::create([
        	'name' => 'L',
        	'description' => 'l',
        ]);
        Size::create([
        	'name' => 'XL',
        	'description' => 'xl',
        ]);
    }
}
