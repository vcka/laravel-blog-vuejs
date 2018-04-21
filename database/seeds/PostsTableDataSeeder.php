<?php

use Illuminate\Database\Seeder;

class PostsTableDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker) {
        for ($i = 0; $i < 50; $i++) {
            $title = $faker->sentence(4);
            $mytime = Carbon\Carbon::now();
            DB::table('posts')->insert([
                'title' => $title,
                'subtitle' => $faker->sentence(2),
                'slug' => str_slug($title),
                'body' => '<p>' . $faker->paragraph(100, true) . '</p>',
                'status' => 1,
                'posted_by' => 1,
                'image' => '9rQ7BlBZARn2sWnxdjlriWUldoLZQtrFGRPBQZes.jpeg',
                'created_at' => $mytime,
                'updated_at' => $mytime,
            ]);

            $id = DB::getPdo()->lastInsertId();

            DB::table('post_tags')->insert([
                'post_id' => $id,
                'tag_id' => 1
            ]);

            DB::table('category_posts')->insert([
                'post_id' => $id,
                'category_id' => 2
            ]);
        }
    }

}
