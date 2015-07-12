<?php

use Illuminate\Database\Seeder;

use Faker\Factory;

use App\Contact;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $faker_generator = new Faker\Generator();
        $faker_generator->addProvider(new Faker\Provider\pt_BR\PhoneNumber($faker_generator));

        for ($i=0; $i < 25 ; $i++) { 
            $contact = new Contact;

            $contact->nama = $faker->name;
            $contact->ponsel = $faker_generator->cellphone(false);
            $contact->keterangan = $faker->text(25);
            $contact->user_id = 1;

            $contact->save();
        }
    }
}
