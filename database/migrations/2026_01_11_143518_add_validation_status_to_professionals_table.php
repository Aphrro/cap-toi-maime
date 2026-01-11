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
            $table->enum('validation_status', ['pending', 'approved', 'rejected'])->default('pending')->after('is_active');
            $table->text('rejection_reason')->nullable()->after('validation_status');
            $table->foreignId('validated_by')->nullable()->constrained('users')->onDelete('set null')->after('rejection_reason');
            $table->timestamp('validated_at')->nullable()->after('validated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->dropForeign(['validated_by']);
            $table->dropColumn(['validation_status', 'rejection_reason', 'validated_by', 'validated_at']);
        });
    }
};
