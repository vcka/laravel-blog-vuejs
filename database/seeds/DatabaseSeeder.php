<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(AdminRoleTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(MethodsTableSeeder::class);        
        $this->call(MethodRoleTableSeeder::class);
        $this->call(PostsTableDataSeeder::class);
        $this->call(CategoriesTableSeeder::class);        
    }
}
