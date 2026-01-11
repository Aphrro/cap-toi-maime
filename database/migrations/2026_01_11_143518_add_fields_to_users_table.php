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
            $table->string('phone', 20)->nullable()->after('email');
            $table->enum('user_type', ['admin', 'parent', 'professional'])->default('parent')->after('phone');
            $table->boolean('is_active')->default(true)->after('user_type');
            $table->timestamp('suspended_at')->nullable()->after('is_active');
            $table->string('suspension_reason')->nullable()->after('suspended_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'user_type', 'is_active', 'suspended_at', 'suspension_reason']);
        });
    }
};
