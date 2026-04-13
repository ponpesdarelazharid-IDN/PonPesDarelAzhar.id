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
            $table->dropColumn('religion');
            $table->string('kecamatan')->nullable()->after('address');
            $table->string('kabupaten_kota')->nullable()->after('kecamatan');
            $table->string('provinsi')->nullable()->after('kabupaten_kota');
            $table->string('nisn', 20)->nullable()->after('gender');
            $table->string('nik_kk', 25)->nullable()->after('nisn');
            $table->string('blood_type', 5)->nullable()->after('nik_kk');
            $table->integer('height')->nullable()->after('blood_type');
            $table->integer('weight')->nullable()->after('height');
            $table->integer('sibling_count')->nullable()->after('weight');
            $table->string('ambition')->nullable()->after('sibling_count');
            $table->string('student_phone', 20)->nullable()->after('ambition');
            $table->string('education_level', 10)->nullable()->after('student_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('religion')->nullable();
            $table->dropColumn([
                'kecamatan', 'kabupaten_kota', 'provinsi', 'nisn', 'nik_kk', 
                'blood_type', 'height', 'weight', 'sibling_count', 
                'ambition', 'student_phone', 'education_level'
            ]);
        });
    }
};
