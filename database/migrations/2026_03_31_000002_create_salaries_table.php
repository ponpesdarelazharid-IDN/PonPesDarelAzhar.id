<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2); // total gaji diterima
            $table->string('month', 7); // format: 2025-03
            $table->text('notes')->nullable();
            $table->decimal('total_fixed', 15, 2)->default(0); // total potongan fixed
            $table->decimal('total_percentage', 15, 2)->default(0); // total alokasi percentage
            $table->decimal('remaining', 15, 2)->default(0); // sisa setelah semua alokasi
            $table->timestamps();

            $table->unique('month'); // 1 entri per bulan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
