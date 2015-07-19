<?php

use Illuminate\Database\Seeder;

use Faker\Factory;

use App\User;

class UsersTableSeeder extends Seeder
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

        for ($i=0; $i < 10 ; $i++) { 
            $user = new User;

            $user->nama = $faker->name;
            $user->username = strtolower($faker->username);
            $user->email = strtolower($faker->email);
            $user->password = Hash::make('123');
            $user->group = 'admin';
            $user->keterangan = $faker->text(20);

            $user->save();
        }
    }
}
