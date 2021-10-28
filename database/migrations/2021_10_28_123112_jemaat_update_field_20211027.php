<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JemaatUpdateField20211027 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jemaats', function (Blueprint $table) {
            $table->string('NamaSuami');
            $table->string('NamaIstri');
            $table->string('TanggalPernikahan');
            $table->string('PelaksanaPemberkatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
