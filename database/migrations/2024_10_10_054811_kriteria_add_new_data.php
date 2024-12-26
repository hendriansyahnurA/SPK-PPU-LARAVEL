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
        Schema::create('kriteria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->index('id');
            $table->unsignedBigInteger('id_aspek');  // Foreign key to aspek
            $table->string('kriteria');
            $table->string('type');
            $table->unsignedBigInteger('id_nilai'); // Foreign key to pm_kriteria_nilai
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_aspek')->references('id')->on('aspek')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kriteria');
    }
};
