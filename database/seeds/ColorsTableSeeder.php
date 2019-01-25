<?php

use Illuminate\Database\Seeder;
use App\Color;
class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	Color::truncate();

     	Color::create([
     		'code' => 'black',
     		'name' => 'black',
     	]);
     	Color::create([
     		'code' => 'red',
     		'name' => 'red',
     	]);
     	Color::create([
     		'code' => 'green',
     		'name' => 'green',
     	]);
     	Color::create([
     		'code' => 'blue',
     		'name' => 'blue',
     	]);   
    }
}
