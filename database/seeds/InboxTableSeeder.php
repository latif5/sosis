<?php

use Illuminate\Database\Seeder;

use Faker\Factory;

use App\Inbox;
use App\Contact;

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
        $faker_generator->addProvider(new Faker\Provider\DateTime($faker_generator));

        // Generate kelas untuk data kelas random
        $kelas_angka = range(7, 12);
        $kelas_alfabet = ['A', 'B', 'C', 'D'];

        // Generate kelas untuk data no. pendaftaran random
        $no_pendaftaran_angka = range(160001, 162000);
        $no_pendaftaran_alfabet = ['A', 'B', 'C', 'D', 'E'];

        // Dummy data tidak valid
        for ($i=0; $i < 20 ; $i++) { 
            $inbox = new Inbox;

            // Ambil data contact untuk data random
            $contact_ponsel = \App\Contact::orderByRaw("RAND()")->first()->ponsel;

            $inbox->ReceivingDateTime = $faker->dateTimeThisYear;
            // $inbox->SenderNumber = $faker_generator->cellphone(false).$faker_generator->cellphone(false);
            $inbox->SenderNumber = $contact_ponsel;
            $inbox->TextDecoded = $faker->text(100);
            $inbox->Processed = 'false';

            $inbox->save();
        }

        // Dummy data konfirmasi
        for ($i=0; $i < 20 ; $i++) { 
            $inbox = new Inbox;

            shuffle($kelas_angka);
            shuffle($kelas_alfabet);

            // Ambil data contact untuk data random
            $contact_ponsel = \App\Contact::orderByRaw("RAND()")->first()->ponsel;
            
            $inbox->ReceivingDateTime = $faker->dateTimeThisYear;
            // $inbox->SenderNumber = $faker_generator->cellphone(false).$faker_generator->cellphone(false);
            $inbox->SenderNumber = $contact_ponsel;
            $inbox->TextDecoded = 'konfirmasi # '.$faker->name().' # '.$kelas_angka[0].$kelas_alfabet[0].' # '.rand(1, 9).' juta # '.$faker_generator->date($format = 'd m Y', $max = 'now').' # '.$faker->name.' # '.$faker->text(10);
            $inbox->Processed = 'false';

            $inbox->save();
        }

        // Dummy data donasi masjid
        for ($i=0; $i < 20 ; $i++) { 
            $inbox = new Inbox;

            shuffle($kelas_angka);
            shuffle($kelas_alfabet);

            // Ambil data contact untuk data random
            $contact_ponsel = \App\Contact::orderByRaw("RAND()")->first()->ponsel;

            $inbox->ReceivingDateTime = $faker->dateTimeThisYear;
            // $inbox->SenderNumber = $faker_generator->cellphone(false).$faker_generator->cellphone(false);
            $inbox->SenderNumber = $contact_ponsel;
            $inbox->TextDecoded = 'masjid # '.rand(1, 9).' juta # '.$faker_generator->date($format = 'd m Y', $max = 'now').' # '.$faker->name.' # '.$faker->text(10);
            $inbox->Processed = 'false';

            $inbox->save();
        }

        // Dummy data psb
        for ($i=0; $i < 20 ; $i++) { 
            $inbox = new Inbox;

            shuffle($no_pendaftaran_angka);
            shuffle($no_pendaftaran_alfabet);

            // Ambil data contact untuk data random
            $contact_ponsel = \App\Contact::orderByRaw("RAND()")->first()->ponsel;
            
            $inbox->ReceivingDateTime = $faker->dateTimeThisYear;
            // $inbox->SenderNumber = $faker_generator->cellphone(false).$faker_generator->cellphone(false);
            $inbox->SenderNumber = $contact_ponsel;
            $inbox->TextDecoded = 'psb # '.$faker->name().' # '.$no_pendaftaran_angka[0].$no_pendaftaran_alfabet[0].' # '.rand(1, 9).' juta # '.$faker_generator->date($format = 'd m Y', $max = 'now').' # '.$faker->name.' # '.$faker->text(10);
            $inbox->Processed = 'false';

            $inbox->save();
        }
    }
}
