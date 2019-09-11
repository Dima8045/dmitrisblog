<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'romance',
        ]);
        DB::table('tags')->insert([
            'name' => 'fiction',
        ]);
        DB::table('tags')->insert([
            'name' => 'fantasy',
        ]);
        DB::table('tags')->insert([
            'name' => 'mystery',
        ]);
        DB::table('tags')->insert([
            'name' => 'thriller',
        ]);
    }
}
