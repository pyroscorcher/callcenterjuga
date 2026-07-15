<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('laporan_bencana', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pelapor');
            $table->text('deskripsi');
            $table->string('kabupaten')->nullable();
            $table->string('infrastruktur_terdampak')->nullable();
            $table->string('status_laporan')->default('Baru'); // Baru, Diproses, Selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_bencanas');
    }
};
