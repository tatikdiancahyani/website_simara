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
        Schema::create('konsumsis', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_konsumsi', ['snack', 'nasi', 'snack dan nasi']); // Jenis konsumsi
            $table->decimal('anggaran', 10, 2); // Anggaran
            $table->integer('jumlah'); // Jumlah
            $table->enum('pajak', ['ppn', 'pph', 'resto']); // Jenis pajak
            $table->decimal('nilai_pajak', 10, 2); // Nilai pajak
            $table->decimal('total', 10, 2); // Total
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsumsis');
    }
};
