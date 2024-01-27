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
        Schema::table('informasis', function (Blueprint $table) {
            $table->dropColumn('Informasi_name');
            $table->dropColumn('mulai');
            $table->dropColumn('selesai');
            $table->smallInteger('id_user');
            $table->text('deskripsi')->change();
            $table->text('judul_informasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasis', function (Blueprint $table) {
            //
        });
    }
};
