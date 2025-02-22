<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pm_kriteria_nilai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kriteria');
            $table->string('nama');
            $table->integer('nilai');
            $table->timestamps();

            // ralasi id_krieria ke table kriteria
            $table->foreign('id_kriteria')->references('id')->on('kriteria')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pm_kriteria_nilai');
    }
};
