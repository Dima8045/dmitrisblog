<?php

use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 150; $i++) {
            DB::table('post_tag')->insert([
                'post_id' => random_int(1, 55),
                'tag_id' => random_int(1, 6),
            ]);
        }
    }
}
