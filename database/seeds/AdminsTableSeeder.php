<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('admins')->delete();
        $mytime = Carbon\Carbon::now();
        DB::table('admins')->insert(array(
            [
                'id' => 1,
                'name' => 'Vivek Chaudhary',
                'email' => 'vivek@gmail.com',
                'password' => Hash::make('123456'),
                'phone' => '1234567890',
                'status' => 1,
                'created_at' => $mytime->toDateTimeString(),
                'updated_at' => $mytime->toDateTimeString()
            ]
        ));
    }

}
