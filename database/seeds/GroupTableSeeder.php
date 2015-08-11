<?php

use Illuminate\Database\Seeder;

use Faker\Factory;

use App\Group;

class GroupTableSeeder extends Seeder
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
            $group = new Group;

            $group->nama = $faker->company;
            $group->keterangan = $faker->text(25);
            $group->user_id = 1;

            $group->save();
        }
    }
}
