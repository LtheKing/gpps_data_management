<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JemaatUpdateField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jemaats', function (Blueprint $table) {
            $table->string('Segment');
            $table->string('StatusKematian');
            $table->string('TanggalKematian');
            $table->string('StatusBaptis');
            $table->string('JenisKelamin');
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
