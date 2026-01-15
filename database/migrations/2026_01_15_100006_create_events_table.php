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
        if (!Schema::hasTable('events')) {
            Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->datetime('start_date');
                $table->datetime('end_date')->nullable();
                $table->string('location')->nullable();
                $table->string('address')->nullable();
                $table->integer('max_professionals')->nullable();
                $table->integer('max_members')->nullable();
                $table->enum('status', ['draft', 'published', 'cancelled', 'completed'])->default('draft');
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
