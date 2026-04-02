<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_id')->constrained('salaries')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('salary_categories')->onDelete('cascade');
            $table->decimal('amount_allocated', 15, 2); // nominal yang dialokasikan
            $table->boolean('is_paid')->default(false); // sudah dibayar/belum
            $table->date('paid_at')->nullable(); // tanggal dibayar
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_allocations');
    }
};
