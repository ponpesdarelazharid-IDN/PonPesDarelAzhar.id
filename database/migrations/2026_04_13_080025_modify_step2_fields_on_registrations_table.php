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
            $table->dropColumn(['parent_job', 'parent_phone']);
            $table->string('father_phone', 20)->nullable()->after('father_name');
            $table->string('mother_phone', 20)->nullable()->after('mother_name');
            $table->string('guardian_name', 255)->nullable()->after('mother_phone');
            $table->string('guardian_phone', 20)->nullable()->after('guardian_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('parent_phone', 20)->nullable();
            $table->string('parent_job', 255)->nullable();
            $table->dropColumn(['father_phone', 'mother_phone', 'guardian_name', 'guardian_phone']);
        });
    }
};
