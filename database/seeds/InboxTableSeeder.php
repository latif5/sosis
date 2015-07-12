<?php

use Illuminate\Database\Seeder;

use Faker\Factory;

use App\Inbox;

class InboxTableSeeder extends Seeder
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
            $inbox = new Inbox;

            $inbox->ReceivingDateTime = $faker->dateTimeThisYear;
            $inbox->SenderNumber = $faker->phoneNumber;
            $inbox->TextDecoded = $faker->text(100);
            $inbox->Processed = 'false';

            $inbox->save();
        }
    }
}
