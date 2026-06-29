<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_settings', function (Blueprint $table) {
            $table->id();

            // ── Active provider ──────────────────────────────────────────────
            $table->string('provider')->nullable()
                  ->comment('Active provider key: msg91 | twilio | textlocal | kaleyra | vonage | aws_sns | fast2sms | sinch');

            // ── MSG91 ────────────────────────────────────────────────────────
            $table->text('msg91_auth_key')->nullable();
            $table->tinyInteger('msg91_route')->default(4)->comment('4 = Transactional, 1 = Promotional');
            $table->string('msg91_dlt_entity_id')->nullable();

            // ── Twilio ───────────────────────────────────────────────────────
            $table->string('twilio_account_sid')->nullable();
            $table->text('twilio_auth_token')->nullable();
            $table->string('twilio_from_number')->nullable();

            // ── Textlocal ────────────────────────────────────────────────────
            $table->text('textlocal_api_key')->nullable();
            $table->string('textlocal_username')->nullable();

            // ── Kaleyra ──────────────────────────────────────────────────────
            $table->string('kaleyra_sid')->nullable();
            $table->text('kaleyra_api_key')->nullable();
            $table->string('kaleyra_dlt_entity_id')->nullable();
            $table->string('kaleyra_dlt_template_id')->nullable();

            // ── Vonage ───────────────────────────────────────────────────────
            $table->string('vonage_api_key')->nullable();
            $table->text('vonage_api_secret')->nullable();
            $table->string('vonage_from')->nullable();

            // ── AWS SNS ──────────────────────────────────────────────────────
            $table->string('aws_access_key_id')->nullable();
            $table->text('aws_secret_access_key')->nullable();
            $table->string('aws_region')->nullable()->default('ap-south-1');
            $table->string('aws_sms_type')->nullable()->default('Transactional');

            // ── Fast2SMS ─────────────────────────────────────────────────────
            $table->text('fast2sms_api_key')->nullable();
            $table->string('fast2sms_route')->nullable()->default('dlt');
            $table->string('fast2sms_language')->nullable()->default('english');

            // ── Sinch ────────────────────────────────────────────────────────
            $table->string('sinch_service_plan_id')->nullable();
            $table->text('sinch_api_token')->nullable();
            $table->string('sinch_from_number')->nullable();

            // ── Sender / Global ──────────────────────────────────────────────
            $table->string('sender_id')->nullable()->comment('DLT-registered sender name, max 11 chars');
            $table->string('default_country_code')->default('91');

            // ── Master switch ────────────────────────────────────────────────
            $table->boolean('enabled')->default(false);

            // ── Notification event toggles ───────────────────────────────────
            $table->boolean('notify_order_placed')->default(false);
            $table->boolean('notify_otp')->default(false);
            $table->boolean('notify_payment_received')->default(false);
            $table->boolean('notify_order_shipped')->default(false);
            $table->boolean('notify_out_for_delivery')->default(false);
            $table->boolean('notify_order_delivered')->default(false);
            $table->boolean('notify_order_cancelled')->default(false);
            $table->boolean('notify_refund_initiated')->default(false);
            $table->boolean('notify_abandoned_cart')->default(false);
            $table->boolean('notify_promotional')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_settings');
    }
};