<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('pages')->delete();
        $mytime = Carbon\Carbon::now();
        DB::table('pages')->insert(array(
            [
                'id' => 1,
                'name' => 'user',
                'label' => 'User',
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString(),
            ],
            [
                'id' => 2,
                'name' => 'post',
                'label' => 'Post',
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString(),
            ],
            [
                'id' => 3,
                'name' => 'home',
                'label' => 'Home',
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString(),
            ],
            [
                'id' => 4,
                'name' => 'role',
                'label' => 'Role',
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString(),
            ],
            [
                'id' => 5,
                'name' => 'permission',
                'label' => 'Permission',
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString(),
            ],
            [
                'id' => 6,
                'name' => 'tag',
                'label' => 'Tag',
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString(),
            ],
            [
                'id' => 7,
                'name' => 'category',
                'label' => 'Category',
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString(),
            ],
            [
                'id' => 8,
                'name' => 'page',
                'label' => 'Page',
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString(),
            ],
            [
                'id' => 9,
                'name' => 'method',
                'label' => 'Method',
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString()
            ]
            ,
            [
                'id' => 12,
                'name' => 'comment',
                'label' => 'Comments',
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString(),
        ]));
    }

}
