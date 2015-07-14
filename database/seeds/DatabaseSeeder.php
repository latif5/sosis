<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(InboxTableSeeder::class);
        $this->call(OutboxTableSeeder::class);
        $this->call(ContactTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(ConfirmationTableSeeder::class);
        $this->call(DonationTableSeeder::class);

        Model::reguard();
    }
}
