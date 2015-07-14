<?php

use Illuminate\Database\Seeder;

use Faker\Factory;

use App\Donation;

class DonationTableSeeder extends Seeder
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
            $donation = new Donation;

            $donation->tanggal = $faker->dateTimeThisYear;
            $donation->ponsel = $faker_generator->cellphone(false);
            $donation->jumlah = rand(1000000, 5000000);
            $donation->tanggal_kirim = '24 Agustus 2015';
            $donation->pengirim = $faker->name;
            $donation->keperluan = $faker->text(15);
            $donation->keterangan = $faker->text(15);
            $donation->status = 'Belum';

            $donation->save();
        }
    }
}
