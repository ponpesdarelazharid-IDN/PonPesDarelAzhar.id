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
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('registration_number')->unique()->after('ppdb_setting_id')->nullable();
            
            // Data Orang Tua
            $table->string('father_name')->nullable()->after('address');
            $table->string('mother_name')->nullable()->after('father_name');
            $table->string('parent_phone')->nullable()->after('mother_name');
            $table->string('parent_job')->nullable()->after('parent_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['registration_number', 'father_name', 'mother_name', 'parent_phone', 'parent_job']);
        });
    }
};
