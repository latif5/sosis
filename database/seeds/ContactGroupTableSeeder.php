<?php

use Illuminate\Database\Seeder;

class ContactGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 35; $i++) { 
            DB::table('contact_group')->insert(
                ['contact_id' => rand(1, 25), 'group_id' => rand(1, 10)]
            );
        }
    }
}
