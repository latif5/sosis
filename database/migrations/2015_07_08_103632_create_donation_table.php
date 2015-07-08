<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation', function (Blueprint $table) {
            $table->increments('id');

            $table->datetime('tanggal');
            $table->string('ponsel');
            $table->string('jumlah');
            $table->string('tanggal_kirim');
            $table->string('pengirim');
            $table->string('keperluan');
            $table->string('keterangan');
            $table->enum('status', ['Belum', 'Sudah', 'Tunda']);

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
