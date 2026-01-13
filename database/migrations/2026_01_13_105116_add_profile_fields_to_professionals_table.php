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
            // Photo et video
            $table->string('profile_photo')->nullable()->after('bio');
            $table->string('video_url')->nullable()->after('profile_photo');

            // Nouveaux textes
            $table->text('who_am_i')->nullable()->after('video_url');
            $table->text('my_approach')->nullable()->after('who_am_i');

            // Disponibilite
            $table->enum('availability_status', ['available', 'limited', 'waitlist'])->default('available')->after('my_approach');

            // Remboursements
            $table->json('reimbursements')->nullable()->after('availability_status');

            // FAQ personnelle
            $table->text('faq_availability')->nullable();
            $table->text('faq_pricing')->nullable();
            $table->text('faq_cancellation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->dropColumn([
                'profile_photo', 'video_url', 'who_am_i', 'my_approach',
                'availability_status', 'reimbursements',
                'faq_availability', 'faq_pricing', 'faq_cancellation'
            ]);
        });
    }
};
