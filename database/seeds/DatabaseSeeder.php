<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RoleSeeder::class);
         $this->call(HospitalSeeder::class);
         $this->call(CountySeeder::class);
         $this->call(BranchSeeder::class);
         $this->call(UserSeeder::class);
    }
}
