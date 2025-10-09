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
        Schema::create('mutasi_aset_masuk', function (Blueprint $table) {
            $table->string('id_mutasi_aset', 11)->primary();
            $table->integer('id_aset');
            $table->foreign('id_aset')->references('id_aset')->on('aset')->onDelete('set null');
            $table->integer('id_pic');
            $table->foreign('id_pic')->references('id_pic')->on('pic')->onDelete('set null');
            $table->integer('id_divisi');
            $table->foreign('id_divisi')->references('id_divisi')->on('divisi')->onDelete('set null');
            $table->integer('id_ruang');
            $table->foreign('id_ruang')->references('id_ruang')->on('ruang')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_aset_masuk');
    }
};
