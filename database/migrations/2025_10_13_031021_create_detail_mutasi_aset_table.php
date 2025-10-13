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
        Schema::create('detail_mutasi_aset', function (Blueprint $table) {
            $table->increments('id_detail_mutasi_aset');
            $table->string('id_mutasi_aset', 11);
            $table->foreign('id_mutasi_aset')->references('id_mutasi_aset')->on('mutasi_aset')->onDelete('cascade');
            $table->string('id_detail_aset', 50);
            $table->foreign('id_detail_aset')->references('id_detail_aset')->on('detail_aset')->onDelete('cascade');
            $table->unsignedInteger('id_divisi');
            $table->foreign('id_divisi')->references('id_divisi')->on('divisi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_mutasi_aset');
    }
};
