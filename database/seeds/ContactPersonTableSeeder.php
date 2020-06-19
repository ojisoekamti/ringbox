<?php

use Illuminate\Database\Seeder;
use App\ContactPerson;
use Faker\Factory as Faker;

class ContactPersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        ContactPerson::create([
            'contactPersonId'=>'CP001',
            'accountId'=>43,
            'name'=>$faker->name,
            'address'=>$faker->address,
            'city'=>$faker->city,
            'postalCode'=>$faker->postcode,
            'phone'=>$faker->phoneNumber,
            'email'=>$faker->email,
            'jobStatus'=>$faker->jobTitle
        ]);
        ContactPerson::create([
            'contactPersonId'=>'CP002',
            'accountId'=>43,
            'name'=>$faker->name,
            'address'=>$faker->address,
            'city'=>$faker->city,
            'postalCode'=>$faker->postcode,
            'phone'=>$faker->phoneNumber,
            'email'=>$faker->email,
            'jobStatus'=>$faker->jobTitle
        ]);
        ContactPerson::create([
            'contactPersonId'=>'CP003',
            'accountId'=>43,
            'name'=>$faker->name,
            'address'=>$faker->address,
            'city'=>$faker->city,
            'postalCode'=>$faker->postcode,
            'phone'=>$faker->phoneNumber,
            'email'=>$faker->email,
            'jobStatus'=>$faker->jobTitle
        ]);
    }
}
