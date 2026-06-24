<?php
// database/migrations/xxxx_create_audio_sections_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audio_sections', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->string('section_image')->nullable();
            $table->string('audio_file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audio_sections');
    }
};