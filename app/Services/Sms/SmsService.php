<?php

namespace App\Services\Sms;

use App\Models\SmsSetting;
use RuntimeException;

class SmsService
{
    protected SmsSetting $settings;

    public function __construct()
    {
        $this->settings = SmsSetting::getInstance();
    }

    /**
     * Send a message via the currently active provider.
     *
     * @param  string|array  $to            Mobile number(s) with country code
     * @param  string        $message
     * @param  string|null   $dltTemplateId  Per-template DLT ID (from SmsTemplate::dlt_template_id)
     */
    public function send(string|array $to, string $message, ?string $dltTemplateId = null): array
    {
        if (! $this->settings->enabled) {
            return ['success' => false, 'response' => 'SMS notifications are disabled.'];
        }

        return $this->driver()->send($to, $message, $dltTemplateId);
    }

    /**
     * Send only if the given notification event is active.
     *
     * Usage: SmsService::make()->sendIfEnabled('order_placed', $mobile, $msg, $dltId);
     */
    public function sendIfEnabled(string $event, string|array $to, string $message, ?string $dltTemplateId = null): array
    {
        if (! $this->settings->shouldNotify($event)) {
            return ['success' => false, 'response' => "Event '{$event}' is disabled."];
        }

        return $this->driver()->send($to, $message, $dltTemplateId);
    }

    /**
     * Normalise a mobile number: strip non-digits, prepend country code if missing.
     */
    public function normalise(string $mobile): string
    {
        $digits = preg_replace('/\D/', '', $mobile);
        $code   = $this->settings->default_country_code ?? '91';

        if (! str_starts_with($digits, $code)) {
            $digits = $code . ltrim($digits, '0');
        }

        return $digits;
    }

    // ── Static factory ───────────────────────────────────────────────────────

    public static function make(): self
    {
        return new self();
    }

    // ── Driver resolution ────────────────────────────────────────────────────

    protected function driver(): Msg91Service /* | TwilioService | … */
    {
        return match ($this->settings->provider) {
            
            'msg91'     => new Msg91Service($this->settings),
            // 'twilio'    => new TwilioService($this->settings),
            // 'textlocal' => new TextlocalService($this->settings),
            // 'vonage'    => new VonageService($this->settings),
            // 'aws_sns'   => new AwsSnsService($this->settings),
            // 'fast2sms'  => new Fast2SmsService($this->settings),
            // 'sinch'     => new SinchService($this->settings),
            default     => throw new RuntimeException(
                "SMS provider '{$this->settings->provider}' is not configured."
            ),
        };
    }
}