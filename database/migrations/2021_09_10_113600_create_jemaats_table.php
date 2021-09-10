<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJemaatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jemaats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NoAnggota');
            $table->string('Nama');
            $table->string('Alamat');
            $table->string('Tlp');
            $table->string('Status');
            $table->string('NamaAyah');
            $table->string('NamaIbu');
            $table->string('TanggalBaptis');
            $table->string('PelaksanaBaptis');
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
        Schema::dropIfExists('jemaats');
    }
}
