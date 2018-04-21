<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        for ($i = 0; $i < 50; $i++) {
            $title = str_random(10);
            $mytime = Carbon\Carbon::now();
            DB::table('categories')->insert([
                'name' => $title,
                'slug' => str_slug($title),
                'created_at' => $mytime,
                'updated_at' => $mytime,
            ]);
        }
    }

}
