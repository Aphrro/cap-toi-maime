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
        Schema::create('user_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('visitor_id', 64);
            $table->string('device_type', 20)->nullable();
            $table->string('referrer')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('landing_page');
            $table->json('questionnaire_data')->nullable();
            $table->integer('pages_viewed')->default(0);
            $table->integer('professionals_viewed')->default(0);
            $table->boolean('questionnaire_completed')->default(false);
            $table->boolean('contact_initiated')->default(false);
            $table->timestamp('started_at');
            $table->timestamp('last_activity_at');
            $table->timestamps();

            $table->index(['visitor_id', 'created_at']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sessions');
    }
};
