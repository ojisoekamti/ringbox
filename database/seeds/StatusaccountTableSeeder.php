<?php

use Illuminate\Database\Seeder;
use App\Statusaccount;
class StatusaccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Statusaccount::create([
            'name'=>'Prospect'
        ]);

        Statusaccount::create([
            'name'=>'Fix'
        ]);
    }
}
