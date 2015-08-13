<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePsbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psb', function (Blueprint $table) {
            $table->increments('id');

            $table->datetime('tanggal');
            $table->string('ponsel');
            $table->string('santri');
            $table->enum('jenjang', ['A', 'B', 'C', 'D', 'E']);
            $table->string('no_pendaftaran');
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
        Schema::drop('psb');
    }
}
