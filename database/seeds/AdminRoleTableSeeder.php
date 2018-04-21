<?php

use Illuminate\Database\Seeder;

class AdminRoleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('admin_role')->delete();
        $mytime = Carbon\Carbon::now();
        DB::table('admin_role')->insert(array(
            [
                'id' => 1,
                'admin_id' => 1,
                'role_id' => 1,
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString()
            ]
        ));
    }

}
