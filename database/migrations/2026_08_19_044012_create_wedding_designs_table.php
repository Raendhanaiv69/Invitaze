<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wedding_designs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('groom_short')->default('Dimas');
            $table->string('bride_short')->default('Sarah');
            $table->string('theme')->default('warm-terracotta');
            $table->string('bg_music_title')->nullable();
            $table->string('bg_music_url')->nullable();
            $table->json('canvas_elements')->nullable();
            $table->json('canvas_config')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wedding_designs');
    }
};