<?php

use Illuminate\Database\Seeder;
use App\Account;
use Faker\Factory as Faker;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 20; $i++) {
            Account::create([
                'accountId' => 'account00' . $i,
                'name' => $faker->name,
                'idGroup' => '1',
                'address' => $faker->address,
                'city' => $faker->city,
                'postalCode' => $faker->postcode,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'idStatusAccount' => '1'
            ]);
        }
    }
}
