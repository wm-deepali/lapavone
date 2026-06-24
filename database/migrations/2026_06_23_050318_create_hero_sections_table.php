<?php
// database/migrations/xxxx_create_hero_sections_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('background_image')->nullable();
            $table->string('heading_line1')->nullable();
            $table->string('heading_line2')->nullable();
            $table->string('btn1_label')->default('Shop All');
            $table->string('btn1_url')->default('shopall.html');
            $table->string('btn2_label')->default('New Arrivals');
            $table->string('btn2_url')->default('shopall.html');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};