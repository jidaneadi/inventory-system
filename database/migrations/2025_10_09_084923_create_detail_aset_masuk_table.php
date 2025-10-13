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
        Schema::create('detail_aset_masuk', function (Blueprint $table) {
            $table->string('id_detail_aset_masuk', 11)->primary();
            $table->integer('id_aset_masuk');
            $table->foreign('id_aset_masuk')->references('id_aset_masuk')->on('aset_masuk')->onDelete('cascade');
            $table->integer('id_detail_aset');
            $table->foreign('id_detail_aset')->references('id_detail_aset')->on('detail_aset')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_aset_masuk');
    }
};
