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
        Schema::create('sample', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_alternatif');  // Foreign key to peserta
            $table->unsignedBigInteger('id_faktor_nilai'); // Foreign key to pm_kriteria_nilai
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_alternatif')->references('id')->on('peserta')->onDelete('cascade');
            $table->foreign('id_faktor_nilai')->references('id')->on('pm_kriteria_nilai')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sample');
    }
};
