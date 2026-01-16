<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            // Type de vidéo (youtube, vimeo, etc.)
            if (!Schema::hasColumn('professionals', 'video_type')) {
                $table->string('video_type')->nullable()->after('video_url');
            }

            // FAQ personnalisée (JSON) - questions/réponses custom
            if (!Schema::hasColumn('professionals', 'personal_faq')) {
                $table->json('personal_faq')->nullable()->after('faq_cancellation');
            }
        });
    }

    public function down(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            if (Schema::hasColumn('professionals', 'video_type')) {
                $table->dropColumn('video_type');
            }
            if (Schema::hasColumn('professionals', 'personal_faq')) {
                $table->dropColumn('personal_faq');
            }
        });
    }
};
