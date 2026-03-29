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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ppdb_setting_id')->constrained()->cascadeOnDelete();
            
            // Biodata
            $table->string('full_name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->string('religion');
            $table->text('address');
            
            // Asal Sekolah
            $table->string('origin_school');
            $table->text('origin_school_address');
            $table->year('graduation_year');
            
            // File Uploads
            $table->string('photo_url')->nullable();
            $table->string('birth_cert_url')->nullable();
            $table->string('ijazah_url')->nullable();
            $table->string('skhu_url')->nullable();
            
            // Status
            $table->enum('status', ['draft', 'pending', 'verified', 'accepted', 'rejected'])->default('draft');
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
