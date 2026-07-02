<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sms_settings', function (Blueprint $table) {
            $table->boolean('notify_order_confirmed')
                ->default(true)
                ->after('notify_order_placed');

            $table->boolean('notify_coupon')
                ->default(false)
                ->after('notify_promotional');
        });
    }

    public function down(): void
    {
        Schema::table('sms_settings', function (Blueprint $table) {
            $table->dropColumn([
                'notify_order_confirmed',
                'notify_coupon',
            ]);
        });
    }
};