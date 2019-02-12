<?php

use Illuminate\Database\Seeder;
use App\Admin;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        Admin::create([
        	'name' => "admin",
        	'username' => 'admin',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('123456'),
        	'is_active' => 1,
        ]);
    }
}
