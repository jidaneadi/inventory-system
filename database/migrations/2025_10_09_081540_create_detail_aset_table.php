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
        Schema::create('detail_aset', function (Blueprint $table) {
            $table->string('id_detail_aset', 50)->primary();
            $table->string('id_aset', 50);
            $table->foreign('id_aset')->references('id_aset')->on('aset')->onDelete('cascade');
            $table->string('serial_number', 50);
            $table->integer('id_bahan');
            $table->foreign('id_bahan')->references('id_bahan')->on('bahan')->onDelete('set null');
            $table->integer('id_merk');
            $table->foreign('id_merk')->references('id_merk')->on('merk')->onDelete('set null');
            $table->integer('id_warna');
            $table->foreign('id_warna')->references('id_warna')->on('warna')->onDelete('set null');
            $table->enum('kondisi', ['normal', 'rusak', 'perlu perbaikan'])->default('normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_aset');
    }
};
