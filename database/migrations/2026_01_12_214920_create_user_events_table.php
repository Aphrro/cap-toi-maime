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
        Schema::create('user_events', function (Blueprint $table) {
            $table->id();
            $table->uuid('session_id');
            $table->string('event_type', 50);
            $table->string('event_category', 30);
            $table->string('event_action', 50);
            $table->string('event_label')->nullable();
            $table->json('event_data')->nullable();
            $table->string('page_url');
            $table->integer('time_on_page')->nullable();
            $table->integer('scroll_depth')->nullable();
            $table->timestamp('created_at');

            $table->foreign('session_id')->references('id')->on('user_sessions')->onDelete('cascade');
            $table->index(['session_id', 'event_type']);
            $table->index(['event_category', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_events');
    }
};
