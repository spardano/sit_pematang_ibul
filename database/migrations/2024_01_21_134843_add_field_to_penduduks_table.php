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
        Schema::table('penduduks', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable();
            $table->smallInteger('hubungan_dalam_keluarga')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->smallInteger('agama')->nullable();
            $table->smallInteger('pendidikan')->nullable();
            $table->smallInteger('jenis_pekerjaan')->nullable();
            $table->string('golongan_darah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            //
        });
    }
};
