<?php

namespace App\Services\Sms;

use App\Models\SmsSetting;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Log;

class SmsDispatcher
{
    /**
     * Resolve, render, and send an SMS for a given event.
     *
     * @param  string  $eventKey   e.g. 'otp', 'order-placed', 'refund'
     * @param  string  $mobile     Raw mobile — will be normalised
     * @param  array   $variables  e.g. ['{otp}' => '123456', '{customer_name}' => 'Rahul']
     * @return array{success: bool, response: mixed}
     */
    public static function send(string $eventKey, string $mobile, array $variables = []): array
    {
        // 1. Map event_key → notify_* column name
        //    e.g. 'order-placed' → 'order_placed', 'abandoned-cart' → 'abandoned_cart'
        $notifyKey = str_replace('-', '_', $eventKey);

        $settings = SmsSetting::getInstance();

        // 2. Check global SMS enabled + per-event toggle
        if (!$settings->shouldNotify($notifyKey)) {
            return ['success' => false, 'response' => "Event '{$eventKey}' is disabled."];
        }

        // 3. Load template — must exist and be enabled
        $template = SmsTemplate::where('event_key', $eventKey)
            ->where('enabled', true)
            ->first();

        if (!$template || empty($template->body)) {
            Log::warning("SmsDispatcher: template '{$eventKey}' not found or disabled.");
            return ['success' => false, 'response' => "Template '{$eventKey}' not configured or disabled."];
        }

        // 4. Render — replace all {variables} in the body
        $message = str_replace(
            array_keys($variables),
            array_values($variables),
            $template->body
        );

        // 5. Send via SmsService → driver
        try {
            $sms    = SmsService::make();
            // $mobile = $sms->normalise($mobile);

            $result = $sms->send($mobile, $message, $template->dlt_template_id);

            if (!$result['success']) {
                Log::warning("SmsDispatcher: send failed for '{$eventKey}'.", [
                    'mobile'   => $mobile,
                    'response' => $result['response'],
                ]);
            }

            return $result;

        } catch (\Throwable $e) {
            Log::error("SmsDispatcher: exception for '{$eventKey}'.", [
                'mobile' => $mobile,
                'error'  => $e->getMessage(),
            ]);

            return ['success' => false, 'response' => $e->getMessage()];
        }
    }

    /**
     * Same as send() but bypasses the enabled/disabled check.
     * Used by test sends from admin panel.
     */
    public static function sendTest(string $eventKey, string $mobile, array $variables = []): array
    {
        $settings = SmsSetting::getInstance();

        if (!$settings->provider) {
            return ['success' => false, 'response' => 'No SMS provider configured.'];
        }
        $template = SmsTemplate::where('event_key', $eventKey)->first();

        if (!$template || empty($template->body)) {
            return ['success' => false, 'response' => "Template '{$eventKey}' not configured."];
        }

        $message = str_replace(
            array_keys($variables),
            array_values($variables),
            $template->body
        );

        try {
            $sms    = SmsService::make();
            // $mobile = $sms->normalise($mobile);

            return $sms->send($mobile, $message, $template->dlt_template_id);

        } catch (\Throwable $e) {
            Log::error("SmsDispatcher test exception for '{$eventKey}'.", ['error' => $e->getMessage()]);

            return ['success' => false, 'response' => $e->getMessage()];
        }
    }
}