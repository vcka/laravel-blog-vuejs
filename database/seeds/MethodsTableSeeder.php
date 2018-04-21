<?php

use Illuminate\Database\Seeder;

class MethodsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('methods')->delete();
        DB::table('methods')->insert(array(
            [
                'id' => 1,
                'page_id' => 1,
                'name' => 'index',
                'label' => 'Index',
                'created_at' => '2017-08-17 10:09:13',
                'updated_at' => '2017-08-22 01:30:28'
            ]
            , [
                'id' => 2,
                'page_id' => 1,
                'name' => 'update',
                'label' => 'Update',
                'created_at' => '2017-08-18 04:38:59',
                'updated_at' => '2017-08-18 04:38:59'
            ]
            , [
                'id' => 3,
                'page_id' => 3,
                'name' => 'index',
                'label' => 'Index',
                'created_at' => '2017-08-18 04:42:54',
                'updated_at' => '2017-08-18 04:42:54'
            ]
            , [
                'id' => 4,
                'page_id' => 1,
                'name' => 'create',
                'label' => 'Create',
                'created_at' => '2017-08-18 04:53:28',
                'updated_at' => '2017-08-18 04:53:28'
            ]
            , [
                'id' => 5,
                'page_id' => 1,
                'name' => 'store',
                'label' => 'Store',
                'created_at' => '2017-08-22 03:12:03',
                'updated_at' => '2017-08-22 03:12:03'
            ]
            , [
                'id' => 6,
                'page_id' => 1,
                'name' => 'show',
                'label' => 'Show',
                'created_at' => '2017-08-22 03:12:18',
                'updated_at' => '2017-08-22 03:12:18'
            ]
            , [
                'id' => 7,
                'page_id' => 1,
                'name' => 'edit',
                'label' => 'Edit',
                'created_at' => '2017-08-22 03:12:35',
                'updated_at' => '2017-08-22 03:12:35'
            ]
            , [
                'id' => 8,
                'page_id' => 1,
                'name' => 'destroy',
                'label' => 'Destroy',
                'created_at' => '2017-08-22 03:13:06',
                'updated_at' => '2017-08-22 03:13:06'
            ]
            , [
                'id' => 9,
                'page_id' => 2,
                'name' => 'index',
                'label' => 'Index',
                'created_at' => '2017-08-22 03:14:30',
                'updated_at' => '2017-08-22 03:14:30'
            ]
            , [
                'id' => 11,
                'page_id' => 2,
                'name' => 'create',
                'label' => 'Create',
                'created_at' => '2017-08-21 18:30:00',
                'updated_at' => '2017-08-21 18:30:00'
            ]
            , [
                'id' => 12,
                'page_id' => 2,
                'name' => 'store',
                'label' => 'Store',
                'created_at' => '2017-08-21 18:30:00',
                'updated_at' => '2017-08-21 18:30:00'
            ]
            , [
                'id' => 13,
                'page_id' => 2,
                'name' => 'show',
                'label' => 'show',
                'created_at' => '2017-08-21 18:30:00',
                'updated_at' => '2017-08-21 18:30:00'
            ]
            , [
                'id' => 14,
                'page_id' => 2,
                'name' => 'edit',
                'label' => 'edit',
                'created_at' => '2017-08-21 18:30:00',
                'updated_at' => '2017-08-21 18:30:00'
            ]
            , [
                'id' => 15,
                'page_id' => 2,
                'name' => 'update',
                'label' => 'update',
                'created_at' => '2017-08-21 18:30:00',
                'updated_at' => '2017-08-21 18:30:00'
            ]
            , [
                'id' => 16,
                'page_id' => 2,
                'name' => 'destroy',
                'label' => 'destroy',
                'created_at' => '2017-08-21 18:30:00',
                'updated_at' => '2017-08-21 18:30:00'
            ]
            , [
                'id' => 17,
                'page_id' => 4,
                'name' => 'store',
                'label' => 'Store',
                'created_at' => '2017-09-21 18:30:00',
                'updated_at' => '2017-09-21 18:30:00'
            ]
            , [
                'id' => 18,
                'page_id' => 4,
                'name' => 'show',
                'label' => 'show',
                'created_at' => '2017-09-21 18:30:00',
                'updated_at' => '2017-09-21 18:30:00'
            ]
            , [
                'id' => 19,
                'page_id' => 4,
                'name' => 'edit',
                'label' => 'edit',
                'created_at' => '2017-09-21 18:30:00',
                'updated_at' => '2017-09-21 18:30:00'
            ]
            , [
                'id' => 20,
                'page_id' => 4,
                'name' => 'update',
                'label' => 'update',
                'created_at' => '2017-09-21 18:30:00',
                'updated_at' => '2017-09-21 18:30:00'
            ]
            , [
                'id' => 21,
                'page_id' => 4,
                'name' => 'destroy',
                'label' => 'destroy',
                'created_at' => '2017-09-21 18:30:00',
                'updated_at' => '2017-09-21 18:30:00'
            ]
            , [
                'id' => 22,
                'page_id' => 5,
                'name' => 'store',
                'label' => 'Store',
                'created_at' => '2017-06-21 18:30:00',
                'updated_at' => '2017-06-21 18:30:00'
            ]
            , [
                'id' => 23,
                'page_id' => 5,
                'name' => 'show',
                'label' => 'show',
                'created_at' => '2017-06-21 18:30:00',
                'updated_at' => '2017-06-21 18:30:00'
            ]
            , [
                'id' => 24,
                'page_id' => 5,
                'name' => 'edit',
                'label' => 'edit',
                'created_at' => '2017-06-21 18:30:00',
                'updated_at' => '2017-06-21 18:30:00'
            ]
            , [
                'id' => 25,
                'page_id' => 5,
                'name' => 'update',
                'label' => 'update',
                'created_at' => '2017-06-21 18:30:00',
                'updated_at' => '2017-06-21 18:30:00'
            ]
            , [
                'id' => 26,
                'page_id' => 5,
                'name' => 'destroy',
                'label' => 'destroy',
                'created_at' => '2017-06-21 18:30:00',
                'updated_at' => '2017-06-21 18:30:00'
            ]
            , [
                'id' => 27,
                'page_id' => 6,
                'name' => 'store',
                'label' => 'Store',
                'created_at' => '2017-10-21 18:30:00',
                'updated_at' => '2017-10-21 18:30:00'
            ]
            , [
                'id' => 28,
                'page_id' => 6,
                'name' => 'show',
                'label' => 'show',
                'created_at' => '2017-10-21 18:30:00',
                'updated_at' => '2017-10-21 18:30:00'
            ]
            , [
                'id' => 29,
                'page_id' => 6,
                'name' => 'edit',
                'label' => 'edit',
                'created_at' => '2017-10-21 18:30:00',
                'updated_at' => '2017-10-21 18:30:00'
            ]
            , [
                'id' => 30,
                'page_id' => 6,
                'name' => 'update',
                'label' => 'update',
                'created_at' => '2017-10-21 18:30:00',
                'updated_at' => '2017-10-21 18:30:00'
            ]
            , [
                'id' => 31,
                'page_id' => 6,
                'name' => 'destroy',
                'label' => 'destroy',
                'created_at' => '2017-10-21 18:30:00',
                'updated_at' => '2017-10-21 18:30:00'
            ]
            , [
                'id' => 32,
                'page_id' => 7,
                'name' => 'store',
                'label' => 'Store',
                'created_at' => '2017-11-21 18:30:00',
                'updated_at' => '2017-11-21 18:30:00'
            ]
            , [
                'id' => 33,
                'page_id' => 7,
                'name' => 'show',
                'label' => 'show',
                'created_at' => '2017-11-21 18:30:00',
                'updated_at' => '2017-11-21 18:30:00'
            ]
            , [
                'id' => 34,
                'page_id' => 7,
                'name' => 'edit',
                'label' => 'edit',
                'created_at' => '2017-11-21 18:30:00',
                'updated_at' => '2017-11-21 18:30:00'
            ]
            , [
                'id' => 35,
                'page_id' => 7,
                'name' => 'update',
                'label' => 'update',
                'created_at' => '2017-11-21 18:30:00',
                'updated_at' => '2017-11-21 18:30:00'
            ]
            , [
                'id' => 36,
                'page_id' => 7,
                'name' => 'destroy',
                'label' => 'destroy',
                'created_at' => '2017-11-21 18:30:00',
                'updated_at' => '2017-11-21 18:30:00'
            ]
            , [
                'id' => 37,
                'page_id' => 8,
                'name' => 'store',
                'label' => 'Store',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 38,
                'page_id' => 8,
                'name' => 'show',
                'label' => 'show',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 39,
                'page_id' => 8,
                'name' => 'edit',
                'label' => 'edit',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 40,
                'page_id' => 8,
                'name' => 'update',
                'label' => 'update',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 41,
                'page_id' => 8,
                'name' => 'destroy',
                'label' => 'destroy',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 42,
                'page_id' => 9,
                'name' => 'store',
                'label' => 'Store',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 43,
                'page_id' => 9,
                'name' => 'show',
                'label' => 'show',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 44,
                'page_id' => 9,
                'name' => 'edit',
                'label' => 'edit',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 45,
                'page_id' => 9,
                'name' => 'update',
                'label' => 'update',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 46,
                'page_id' => 9,
                'name' => 'destroy',
                'label' => 'destroy',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 47,
                'page_id' => 5,
                'name' => 'index',
                'label' => 'index',
                'created_at' => '2017-06-21 18:30:00',
                'updated_at' => '2017-06-21 18:30:00'
            ]
            , [
                'id' => 48,
                'page_id' => 6,
                'name' => 'index',
                'label' => 'index',
                'created_at' => '2017-10-21 18:30:00',
                'updated_at' => '2017-10-21 18:30:00'
            ]
            , [
                'id' => 49,
                'page_id' => 7,
                'name' => 'index',
                'label' => 'index',
                'created_at' => '2017-11-21 18:30:00',
                'updated_at' => '2017-11-21 18:30:00'
            ]
            , [
                'id' => 50,
                'page_id' => 8,
                'name' => 'index',
                'label' => 'index',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 51,
                'page_id' => 9,
                'name' => 'index',
                'label' => 'index',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 52,
                'page_id' => 4,
                'name' => 'index',
                'label' => 'index',
                'created_at' => '2017-06-21 18:30:00',
                'updated_at' => '2017-06-21 18:30:00'
            ]
            , [
                'id' => 53,
                'page_id' => 4,
                'name' => 'create',
                'label' => 'create',
                'created_at' => '2017-06-21 18:30:00',
                'updated_at' => '2017-06-21 18:30:00'
            ]
            , [
                'id' => 54,
                'page_id' => 5,
                'name' => 'create',
                'label' => 'create',
                'created_at' => '2017-06-21 18:30:00',
                'updated_at' => '2017-06-21 18:30:00'
            ]
            , [
                'id' => 55,
                'page_id' => 6,
                'name' => 'create',
                'label' => 'create',
                'created_at' => '2017-10-21 18:30:00',
                'updated_at' => '2017-10-21 18:30:00'
            ]
            , [
                'id' => 56,
                'page_id' => 7,
                'name' => 'create',
                'label' => 'create',
                'created_at' => '2017-11-21 18:30:00',
                'updated_at' => '2017-11-21 18:30:00'
            ]
            , [
                'id' => 57,
                'page_id' => 8,
                'name' => 'create',
                'label' => 'create',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 58,
                'page_id' => 9,
                'name' => 'create',
                'label' => 'create',
                'created_at' => '2017-12-21 18:30:00',
                'updated_at' => '2017-12-21 18:30:00'
            ]
            , [
                'id' => 70,
                'page_id' => 12,
                'name' => 'approveComment',
                'label' => 'Approve Comment',
                'created_at' => '2018-03-22 18:30:00',
                'updated_at' => '2018-03-22 18:30:00'
            ],
            [
                'id' => 71,
                'page_id' => 12,
                'name' => 'index',
                'label' => 'index',
                'created_at' => '2018-03-22 18:30:00',
                'updated_at' => '2018-03-22 18:30:00'
            ],
            [
                'id' => 72,
                'page_id' => 2,
                'name' => 'getPostData',
                'label' => 'getData',
                'created_at' => '2018-03-22 18:30:00',
                'updated_at' => '2018-03-22 18:30:00'
            ],
            [
                'id' => 73,
                'page_id' => 7,
                'name' => 'getData',
                'label' => 'getData',
                'created_at' => '2018-03-22 18:30:00',
                'updated_at' => '2018-03-22 18:30:00'
            ],
            [
                'id' => 74,
                'page_id' => 6,
                'name' => 'getData',
                'label' => 'getData',
                'created_at' => '2018-03-22 18:30:00',
                'updated_at' => '2018-03-22 18:30:00'
            ],
            [
                'id' => 75,
                'page_id' => 12,
                'name' => 'getData',
                'label' => 'getData',
                'created_at' => '2018-03-22 18:30:00',
                'updated_at' => '2018-03-22 18:30:00'
            ]
			,
            [
                'id' => 76,
                'page_id' => 1,
                'name' => 'getData',
                'label' => 'getData',
                'created_at' => '2018-03-22 18:30:00',
                'updated_at' => '2018-03-22 18:30:00'
            ],
            [
                'id' => 77,
                'page_id' => 4,
                'name' => 'getData',
                'label' => 'getData',
                'created_at' => '2018-03-22 18:30:00',
                'updated_at' => '2018-03-22 18:30:00'
            ],
            [
                'id' => 78,
                'page_id' => 8,
                'name' => 'getData',
                'label' => 'getData',
                'created_at' => '2018-03-22 18:30:00',
                'updated_at' => '2018-03-22 18:30:00'
            ],
            [
                'id' => 79,
                'page_id' => 9,
                'name' => 'getData',
                'label' => 'getData',
                'created_at' => '2018-03-22 18:30:00',
                'updated_at' => '2018-03-22 18:30:00'
            ]
        ));
    }
}