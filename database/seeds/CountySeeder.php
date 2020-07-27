<?php

use App\County;
use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       County::create(['name'=>'KIAMBU', 'code'=>'KIAM']);
       County::create(['name'=>'NAIROBI','code'=>'NAI']);
       County::create(['name'=>'NYANDURUA','code'=>'NYA']);
       County::create(['name'=>'NYERI','code'=>'NYERI']);
       County::create(['name'=>'BARINGO','code'=>'BAR']);
       County::create(['name'=>'MOMBASA','code'=>'MOMB']);
       County::create(['name'=>'VIHIGA','code'=>'VIH']);
       County::create(['name'=>'TURKANA','code'=>'TUR']);
       County::create(['name'=>'TAITA','code'=>'TAIT']);
       County::create(['name'=>'KISUMU','code'=>'KIS']);
    }

}
