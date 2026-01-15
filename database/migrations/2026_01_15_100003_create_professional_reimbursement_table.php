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
        if (!Schema::hasTable('professional_reimbursement')) {
            Schema::create('professional_reimbursement', function (Blueprint $table) {
                $table->id();
                $table->foreignId('professional_id')->constrained()->onDelete('cascade');
                $table->foreignId('reimbursement_type_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->unique(['professional_id', 'reimbursement_type_id'], 'pro_reimb_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_reimbursement');
    }
};
