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
        Schema::create('recommendation_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('trigger_context');
            $table->json('conditions');
            $table->string('recommendation_type');
            $table->json('recommendation_data');
            $table->integer('priority')->default(50);
            $table->boolean('is_active')->default(true);
            $table->integer('times_shown')->default(0);
            $table->integer('times_clicked')->default(0);
            $table->timestamps();

            $table->index(['trigger_context', 'is_active', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendation_rules');
    }
};
