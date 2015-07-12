<?php

use Illuminate\Database\Seeder;

use Faker\Factory;

use App\Outbox;

class OutboxTableSeeder extends Seeder
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

        for ($i=0; $i <= 20 ; $i++) { 
            $outbox = new Outbox;

            $outbox->UpdatedInDB = $faker->dateTimeThisYear;
            $outbox->DestinationNumber = $faker_generator->cellphone(false);
            $outbox->TextDecoded = $faker->text(100);
            $outbox->Class = -1;

            $outbox->save();
        }
    }
}
