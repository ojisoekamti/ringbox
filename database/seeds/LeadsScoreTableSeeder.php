<?php

use Illuminate\Database\Seeder;
use App\LeadsScore;
use Faker\Factory as Faker;

class LeadsScoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadsScore::create([
            'nama' => 'In-Progress',
            'score' => '50',
            'description' => 'masuk keluar masuk keluar'
        ]);
        LeadsScore::create([
            'nama' => 'In-Progress II',
            'score' => '75',
            'description' => 'masuk keluar masuk keluar'
        ]);
        LeadsScore::create([
            'nama' => 'Ready to Opportunity',
            'score' => '100',
            'description' => 'masuk keluar masuk keluar'
        ]);
    }
}
