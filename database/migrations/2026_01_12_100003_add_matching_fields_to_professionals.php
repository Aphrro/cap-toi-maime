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
        Schema::table('professionals', function (Blueprint $table) {
            // Modes de consultation
            if (!Schema::hasColumn('professionals', 'mode_cabinet')) {
                $table->boolean('mode_cabinet')->default(true)->after('consultation_type');
            }
            if (!Schema::hasColumn('professionals', 'mode_visio')) {
                $table->boolean('mode_visio')->default(false)->after('mode_cabinet');
            }
            if (!Schema::hasColumn('professionals', 'mode_domicile')) {
                $table->boolean('mode_domicile')->default(false)->after('mode_visio');
            }

            // Rating et avis
            if (!Schema::hasColumn('professionals', 'rating')) {
                $table->decimal('rating', 2, 1)->nullable()->after('views_count');
            }
            if (!Schema::hasColumn('professionals', 'reviews_count')) {
                $table->unsignedInteger('reviews_count')->default(0)->after('rating');
            }
        });

        // Index pour le matching
        Schema::table('professionals', function (Blueprint $table) {
            $table->index(['is_active', 'validation_status'], 'professionals_active_validated_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->dropIndex('professionals_active_validated_idx');
            $table->dropColumn([
                'mode_cabinet',
                'mode_visio',
                'mode_domicile',
                'rating',
                'reviews_count',
            ]);
        });
    }
};
