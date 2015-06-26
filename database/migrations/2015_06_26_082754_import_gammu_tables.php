<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImportGammuTables.php extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Import file schema bawaan gammu
        DB::unprepared(File::get('gammu.sql'));

        // Menghapus tabel bawaan gammu yang kurang perlu
        Schema::dropIfExists('pbk');
        Schema::dropIfExists('pbk_groups');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daemons');
        Schema::dropIfExists('gammu');
        Schema::dropIfExists('inbox');
        Schema::dropIfExists('outbox');
        Schema::dropIfExists('outbox_multipart');
        Schema::dropIfExists('pbk');
        Schema::dropIfExists('pbk_groups');
        Schema::dropIfExists('phones');
        Schema::dropIfExists('sentitems');
    }
}
