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
        // Add missing columns to cantons
        Schema::table('cantons', function (Blueprint $table) {
            if (!Schema::hasColumn('cantons', 'order')) {
                $table->integer('order')->default(0)->after('slug');
            }
            if (!Schema::hasColumn('cantons', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('order');
            }
        });

        // Add missing columns to cities
        Schema::table('cities', function (Blueprint $table) {
            if (!Schema::hasColumn('cities', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('postal_code');
            }
        });

        // Add missing columns to specialties
        Schema::table('specialties', function (Blueprint $table) {
            if (!Schema::hasColumn('specialties', 'order')) {
                $table->integer('order')->default(0)->after('description');
            }
        });

        // Add profession_id and canton_id to professionals if not exist
        Schema::table('professionals', function (Blueprint $table) {
            if (!Schema::hasColumn('professionals', 'profession_id')) {
                $table->foreignId('profession_id')->nullable()->after('category_id');
            }
            if (!Schema::hasColumn('professionals', 'canton_id')) {
                $table->foreignId('canton_id')->nullable()->after('city_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cantons', function (Blueprint $table) {
            $table->dropColumn(['order', 'is_active']);
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('specialties', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('professionals', function (Blueprint $table) {
            $table->dropColumn(['profession_id', 'canton_id']);
        });
    }
};
