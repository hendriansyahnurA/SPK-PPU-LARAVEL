<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("peserta", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("nama");
            $table->string("jenis_kelamin");
            $table->string("nim")->unique();
            $table->string("prodi");
            $table->string("semester");
            $table->string("ipk");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};