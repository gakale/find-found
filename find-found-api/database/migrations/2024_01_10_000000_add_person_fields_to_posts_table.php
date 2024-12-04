<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Ajouter les champs spécifiques aux personnes disparues
            $table->string('person_name')->nullable();
            $table->integer('person_age')->nullable();
            $table->string('person_gender')->nullable();
            $table->string('person_height')->nullable();
            $table->string('person_weight')->nullable();
            $table->text('person_description')->nullable();
            $table->string('last_seen_location')->nullable();
            $table->timestamp('last_seen_date')->nullable();
            $table->text('distinctive_features')->nullable();
            $table->string('clothes_worn')->nullable();
            $table->boolean('is_urgent')->default(false);
            $table->string('police_report_number')->nullable();

            // Modifier la colonne type pour inclure missing_person
            $table->string('type')->default('lost')->change();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Retirer les champs ajoutés
            $table->dropColumn([
                'person_name',
                'person_age',
                'person_gender',
                'person_height',
                'person_weight',
                'person_description',
                'last_seen_location',
                'last_seen_date',
                'distinctive_features',
                'clothes_worn',
                'is_urgent',
                'police_report_number'
            ]);

            // Remettre l'ancien type
            $table->string('type')->default('lost')->change();
        });
    }
};
