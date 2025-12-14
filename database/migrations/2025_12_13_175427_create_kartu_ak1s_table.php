<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kartu_ak1s', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pencari_kerja_id')->unique()->constrained('pencari_kerjas')->cascadeOnDelete();

            $table->string('nomor_ak1', 50)->unique();
            $table->date('tanggal_terbit')->nullable();
            $table->date('tanggal_berlaku')->nullable();
            $table->string('file_pdf')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_ak1s');
    }
};
