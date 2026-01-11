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
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();

            // Identite
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->text('bio')->nullable();

            // Contact
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();

            // Adresse
            $table->string('address')->nullable();
            $table->foreignId('city_id')->nullable()->constrained();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Professionnel
            $table->foreignId('category_id')->constrained();
            $table->json('specialties')->nullable();
            $table->json('languages')->nullable();
            $table->string('consultation_type')->nullable();

            // Visibilite
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamp('verified_at')->nullable();

            // Stats
            $table->unsignedInteger('views_count')->default(0);

            // Relation user
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
