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
            $table->string('full_name')->nullable()->change();
            $table->string('birth_place')->nullable()->change();
            $table->date('birth_date')->nullable()->change();
            $table->enum('gender', ['L', 'P'])->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->string('origin_school')->nullable()->change();
            $table->text('origin_school_address')->nullable()->change();
            $table->year('graduation_year')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('full_name')->nullable(false)->change();
            $table->string('birth_place')->nullable(false)->change();
            $table->date('birth_date')->nullable(false)->change();
            $table->enum('gender', ['L', 'P'])->nullable(false)->change();
            $table->text('address')->nullable(false)->change();
            $table->string('origin_school')->nullable(false)->change();
            $table->text('origin_school_address')->nullable(false)->change();
            $table->year('graduation_year')->nullable(false)->change();
        });
    }
};
