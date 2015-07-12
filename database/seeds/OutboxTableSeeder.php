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

        for ($i=0; $i <= 20 ; $i++) { 
            $outbox = new Outbox;

            $outbox->UpdatedInDB = $faker->dateTimeThisYear;
            $outbox->DestinationNumber = $faker->phoneNumber;
            $outbox->TextDecoded = $faker->text(100);
            $outbox->Class = -1;

            $outbox->save();
        }
    }
}
