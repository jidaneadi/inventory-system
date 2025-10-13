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
        Schema::create('history_aset', function (Blueprint $table) {
            $table->id('id_history');
            $table->string('id_mutasi_aset', 11);
            $table->foreign('id_mutasi_aset')->references('id_mutasi_aset')->on('mutasi_aset')->onDelete('cascade');
            $table->enum('jenis_mutasi', ['masuk', 'keluar'])->default('masuk');
            $table->date('tanggal_mutasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_aset');
    }
};
