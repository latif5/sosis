<?php

use Illuminate\Database\Seeder;

use Faker\Factory;

use App\Confirmation;

class ConfirmationTableSeeder extends Seeder
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

        // Generate kelas untuk data kelas random
        $kelas_angka = range(7, 12);
        $kelas_alfabet = ['A', 'B', 'C', 'D'];

        for ($i=0; $i < 20 ; $i++) { 
            $confirmation = new Confirmation;

            shuffle($kelas_angka);
            shuffle($kelas_alfabet);

            $confirmation->tanggal = $faker->dateTimeThisYear;
            $confirmation->ponsel = $faker_generator->cellphone(false);
            $confirmation->santri = $faker->name;
            $confirmation->kelas = $kelas_angka[0].$kelas_alfabet[0];
            $confirmation->jumlah = rand(1000000, 5000000);
            $confirmation->tanggal_kirim = '24 Agustus 2015';
            $confirmation->pengirim = $faker->name;
            $confirmation->keperluan = $faker->text(15);
            $confirmation->status = 'Belum';

            $confirmation->save();
        }
    }
}
