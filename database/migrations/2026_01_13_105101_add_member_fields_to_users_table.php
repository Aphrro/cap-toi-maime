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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('member_status', ['pending', 'approved', 'rejected'])->default('pending')->after('email');
            $table->timestamp('member_approved_at')->nullable()->after('member_status');
            $table->string('member_rejection_reason')->nullable()->after('member_approved_at');
            $table->string('association_member_id')->nullable()->after('member_rejection_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['member_status', 'member_approved_at', 'member_rejection_reason', 'association_member_id']);
        });
    }
};
