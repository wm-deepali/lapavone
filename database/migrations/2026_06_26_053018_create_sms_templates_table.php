<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * SMS Templates table
     * One row per event key (otp, order-placed, order-confirmed, etc.)
     * Provider and Sender ID are read from sms_settings — NOT stored here.
     */
    public function up(): void
    {
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->id();

            // Event key — unique identifier e.g. 'otp', 'order-placed', 'order-shipped'
            $table->string('event_key', 60)->unique();

            // Template status
            $table->boolean('enabled')->default(false);

            // DLT / provider fields
            $table->string('dlt_template_id', 50)->nullable();
            $table->enum('template_type', [
                'transactional',
                'promotional',
                'service-implicit',
                'service-explicit',
            ])->default('transactional');

            // SMS message body — contains {variable} placeholders
            $table->text('body')->nullable();

            // --- Event-specific extra settings stored as JSON ---
            // OTP event:     { "otp_length": 6, "otp_expiry": 10, "max_retries": 3 }
            // Abandoned cart: { "delay": "1h" }
            // Others:         null
            $table->json('extra_settings')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_templates');
    }
};