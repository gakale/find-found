<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();

            // Un utilisateur ou une IP ne peut voir qu'une fois par jour
            $table->unique(['post_id', 'ip_address', 'user_id', 'created_at'], 'unique_view_per_day');
        });

        // Ajout d'une colonne views_count dans la table posts pour le cache
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedInteger('views_count')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('views');
        
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('views_count');
        });
    }
};
