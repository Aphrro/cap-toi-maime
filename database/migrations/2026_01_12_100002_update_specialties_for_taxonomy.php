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
        Schema::table('specialties', function (Blueprint $table) {
            if (!Schema::hasColumn('specialties', 'category_id')) {
                $table->foreignId('category_id')->nullable()->after('id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('specialties', 'sort_order')) {
                $table->unsignedInteger('sort_order')->default(0)->after('description');
            }
        });

        // Table des synonymes
        if (!Schema::hasTable('specialty_synonyms')) {
            Schema::create('specialty_synonyms', function (Blueprint $table) {
                $table->id();
                $table->foreignId('specialty_id')->constrained()->onDelete('cascade');
                $table->string('synonym')->unique();
                $table->timestamps();

                $table->index('synonym');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialty_synonyms');

        Schema::table('specialties', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'sort_order']);
        });
    }
};
