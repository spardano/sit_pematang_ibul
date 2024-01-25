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
        Schema::create('pengajuan_layanans', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('id_user');
            $table->smallInteger('id_layanan_desa');
            $table->string('nik');
            $table->text('data_field')->nullable();
            $table->text('uploaded_dokumen')->nullable();
            $table->smallInteger('status_pengajuan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_layanans');
    }
};
