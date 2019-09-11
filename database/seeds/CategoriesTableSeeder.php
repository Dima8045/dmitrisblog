<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Horror',
        ]);
        DB::table('categories')->insert([
            'name' => 'Drama',
        ]);
        DB::table('categories')->insert([
            'name' => 'Fantasy',
        ]);
    }
}
