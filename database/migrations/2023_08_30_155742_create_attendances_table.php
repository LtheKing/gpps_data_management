<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('jemaat_id')->unsigned();
            $table->foreign('jemaat_id')->references('id')->on('jemaats')
                ->onDelete('cascade');
            $table->dateTime('tgl_kehadiran');
            $table->string('cabang');
            $table->string('ibadah_ke');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
