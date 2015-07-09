<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmation', function (Blueprint $table) {
            $table->increments('id');

            $table->datetime('tanggal');
            $table->string('ponsel');
            $table->string('santri');
            $table->string('kelas');
            $table->string('jumlah');
            $table->string('tanggal_kirim');
            $table->string('pengirim');
            $table->string('keperluan');
            $table->enum('status', ['Belum', 'Sudah', 'Tunda'])
                ->default('Belum');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('confirmation');
    }
}
