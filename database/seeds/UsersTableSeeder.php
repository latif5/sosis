<?php

use Illuminate\Database\Seeder;

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
        $user = new User;

        $user->nama = 'Miftah Afina';
        $user->username = 'miftahafina';
        $user->email = 'surat@miftahafina.com';
        $user->password = Hash::make('123');
        $user->group = 'admin';
        $user->keterangan = 'Founder SOSIS';

        $user->save();
    }
}
