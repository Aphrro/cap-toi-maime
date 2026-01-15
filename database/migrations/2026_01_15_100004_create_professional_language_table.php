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
        if (!Schema::hasTable('professional_language')) {
            Schema::create('professional_language', function (Blueprint $table) {
                $table->id();
                $table->foreignId('professional_id')->constrained()->onDelete('cascade');
                $table->foreignId('language_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->unique(['professional_id', 'language_id'], 'pro_lang_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_language');
    }
};
