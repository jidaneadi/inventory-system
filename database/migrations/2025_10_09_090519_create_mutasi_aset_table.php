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
        Schema::create('mutasi_aset', function (Blueprint $table) {
            $table->string('id_mutasi_aset', 11)->primary();
            $table->string('id_aset', 50);
            $table->foreign('id_aset')->references('id_aset')->on('aset')->onDelete('cascade');
            $table->unsignedInteger('id_pic');
            $table->foreign('id_pic')->references('id_pic')->on('pic')->onDelete('cascade');
            // $table->unsignedInteger('id_divisi');
            // $table->foreign('id_divisi')->references('id_divisi')->on('divisi')->onDelete('cascade');
            // $table->unsignedInteger('id_ruang');
            // $table->foreign('id_ruang')->references('id_ruang')->on('ruang')->onDelete('cascade');
            $table->date('tanggal_mutasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_aset');
    }
};
