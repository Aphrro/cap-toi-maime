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
            // Diplomes et formations (JSON: [{title, institution, year}])
            $table->json('diplomas')->nullable()->after('bio');

            // Numero professionnel (GLN, RCC, ASCA, etc.)
            $table->string('professional_number', 50)->nullable()->after('diplomas');
            $table->string('professional_number_type', 30)->nullable()->after('professional_number'); // GLN, RCC, ASCA, FSP, etc.

            // Experience
            $table->unsignedTinyInteger('years_experience')->nullable()->after('professional_number_type');

            // Assurance RC professionnelle
            $table->string('insurance_company')->nullable()->after('years_experience');
            $table->string('insurance_number')->nullable()->after('insurance_company');

            // Formation specifique phobie scolaire
            $table->text('school_phobia_training')->nullable()->after('insurance_number');

            // Documents justificatifs (chemins des fichiers)
            $table->json('credential_documents')->nullable()->after('school_phobia_training');

            // Acceptation conditions
            $table->boolean('accepts_terms')->default(false)->after('credential_documents');
            $table->boolean('accepts_ethics')->default(false)->after('accepts_terms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->dropColumn([
                'diplomas',
                'professional_number',
                'professional_number_type',
                'years_experience',
                'insurance_company',
                'insurance_number',
                'school_phobia_training',
                'credential_documents',
                'accepts_terms',
                'accepts_ethics',
            ]);
        });
    }
};
