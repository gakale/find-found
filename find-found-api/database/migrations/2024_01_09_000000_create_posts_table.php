<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('type')->default('lost');
            $table->string('location');
            $table->dateTime('date');
            $table->string('contact_phone');
            $table->string('contact_email')->nullable();
            $table->boolean('has_reward')->default(false);
            $table->decimal('reward_amount', 10, 2)->nullable();
            $table->json('images')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
