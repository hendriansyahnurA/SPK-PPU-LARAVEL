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
            $table->string('nama');
            $table->integer('nilai');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pm_kriteria_nilai');
    }
};
