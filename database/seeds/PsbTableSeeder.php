<?php

use Illuminate\Database\Seeder;

use Faker\Factory;

use App\Psb;

class PsbTableSeeder extends Seeder
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
        $no_pendaftaran_angka = range(160001, 162000);
        $no_pendaftaran_alfabet = ['A', 'B', 'C', 'D', 'E'];

        for ($i=0; $i < 20 ; $i++) { 
            $psb = new Psb;

            shuffle($no_pendaftaran_angka);
            shuffle($no_pendaftaran_alfabet);

            $psb->tanggal = $faker->dateTimeThisYear;
            $psb->ponsel = $faker_generator->cellphone(false);
            $psb->santri = $faker->name;
            $psb->jenjang = $no_pendaftaran_alfabet[0];
            $psb->no_pendaftaran = $no_pendaftaran_alfabet[0].$no_pendaftaran_angka[0];
            $psb->jumlah = rand(1000000, 5000000);
            $psb->tanggal_kirim = '24 Agustus 2015';
            $psb->pengirim = $faker->name;
            $psb->keperluan = $faker->text(15);
            $psb->status = 'Belum';

            $psb->save();
        }
    }
}
