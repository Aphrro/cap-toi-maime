<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Type d'événement (general, speed_dating, conference, workshop)
            if (!Schema::hasColumn('events', 'event_type')) {
                $table->string('event_type')->default('general')->after('status');
            }

            // Inscription obligatoire ?
            if (!Schema::hasColumn('events', 'registration_required')) {
                $table->boolean('registration_required')->default(false)->after('event_type');
            }

            // Lien d'inscription externe
            if (!Schema::hasColumn('events', 'registration_url')) {
                $table->string('registration_url')->nullable()->after('registration_required');
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $columns = ['event_type', 'registration_required', 'registration_url'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('events', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
