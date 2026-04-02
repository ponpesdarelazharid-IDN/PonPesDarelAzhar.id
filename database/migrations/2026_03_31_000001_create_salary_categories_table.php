<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['fixed', 'percentage'])->default('fixed');
            $table->decimal('value', 15, 2)->default(0); // nominal (fixed) atau persen (percentage)
            $table->integer('priority')->default(1); // urutan pemotongan, makin kecil makin duluan
            $table->string('icon')->default('💰'); // emoji icon
            $table->string('color')->default('#6366f1'); // warna untuk chart
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_categories');
    }
};
