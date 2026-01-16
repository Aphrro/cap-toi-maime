<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('event_professional')) {
            Schema::create('event_professional', function (Blueprint $table) {
                $table->id();
                $table->foreignId('event_id')->constrained()->cascadeOnDelete();
                $table->foreignId('professional_id')->constrained()->cascadeOnDelete();
                $table->string('status')->default('registered'); // registered, confirmed, cancelled
                $table->timestamps();

                $table->unique(['event_id', 'professional_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('event_professional');
    }
};
