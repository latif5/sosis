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

        $faker_generator = new Faker\Generator();
        $faker_generator->addProvider(new Faker\Provider\pt_BR\PhoneNumber($faker_generator));

        for ($i=0; $i < 20 ; $i++) { 
            $inbox = new Inbox;

            $inbox->ReceivingDateTime = $faker->dateTimeThisYear;
            $inbox->SenderNumber = $faker_generator->cellphone(false).$faker_generator->cellphone(false);
            $inbox->TextDecoded = $faker->text(100);
            $inbox->Processed = 'false';

            $inbox->save();
        }
    }
}
