<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'permission' => '5',
            'password' => bcrypt('admin'),
            'created_at' => now(),
        ]);

        DB::table('configs')->insert([
            'app_name' => 'Website',
            'font_family' => 'Helvetica, Arial',
            'font_size' => 'large',
            'font_weight' => 'bold',
            'background' => 'null',
            'background_color' => 'null',
            'navbar_bcolor' => 'fff',
            'navbar_wcolor' => 'fff',
            'navbar_size' => 'large',
            'is_open' => '1',
            'created_at' => now(),
        ]);
    }
}
