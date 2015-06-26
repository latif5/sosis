<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_group', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('contact_id')
                ->unsigned();
            $table->foreign('contact_id')
                ->references('id')
                ->on('contact')
                ->onDelete('CASCADE');

            $table->integer('group_id')
                ->unsigned();
            $table->foreign('group_id')
                ->references('id')
                ->on('group')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contact_group');
    }
}
