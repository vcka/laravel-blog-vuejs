<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('roles')->delete();
        DB::table('roles')->insert(array(
            [
                'id' => 1,
                'name' => 'Super Admin',
                'created_at' => '2017-08-17 09:56:19',
                'updated_at' => '2017-08-17 09:56:19'
            ]
        ));
    }

}
