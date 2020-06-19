<?php

use Illuminate\Database\Seeder;
use App\Actlist;
use App\User;

class ActlistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Actlist::truncate();

        $id = User::where('name', 'administrator')->first();

        Actlist::create([
            'actId'=>'AP-01',
            'idSales'=>'1',
            'idType'=>'1',
            'subject'=>'Follow Up',
            'email'=>'abdulghoji31@gmail.com',
            'date'=>'2020-04-30',
            'account'=>'PT Mandiri Jaya',
            'contactName'=>'Rifan Maulana',
            'phoneCall'=>'081288372226',
            'address'=>'Jl. Haji Makmum',
            'remarks'=>'Pertemuan Hari ini',
            'estimateTime'=>'12:00',
            'status'=>'1',
            'clockIn'=>'12:00',
            'clockOut'=>'15:00',
        ]);

        Actlist::create([
            'actId'=>'EM-01',
            'idSales'=>'1',
            'idType'=>'2',
            'subject'=>'Follow Up',
            'email'=>'abdulghoji31@gmail.com',
            'date'=>'2020-04-30',
            'account'=>'PT Mandiri Jaya',
            'contactName'=>'Rifan Maulana',
            'phoneCall'=>'081288372226',
            'address'=>'Jl. Haji Makmum',
            'remarks'=>'Pertemuan Hari ini',
            'estimateTime'=>'12:00',
            'status'=>'1',
            'clockIn'=>'12:00',
            'clockOut'=>'15:00',
        ]);

        Actlist::create([
            'actId'=>'PH-01',
            'idSales'=>'1',
            'idType'=>'3',
            'subject'=>'Follow Up',
            'email'=>'abdulghoji31@gmail.com',
            'account'=>'PT Mandiri Jaya',
            'date'=>'2020-04-30',
            'contactName'=>'Rifan Maulana',
            'phoneCall'=>'081288372226',
            'address'=>'Jl. Haji Makmum',
            'remarks'=>'Pertemuan Hari ini',
            'estimateTime'=>'12:00',
            'status'=>'1',
            'clockIn'=>'12:00',
            'clockOut'=>'15:00',
        ]);
    }
}
