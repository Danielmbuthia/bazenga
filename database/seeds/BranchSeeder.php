<?php

use App\Branch;
use App\Insurance;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Branch::class,10)->create();
        factory(Insurance::class,5)->create();
    }

}
