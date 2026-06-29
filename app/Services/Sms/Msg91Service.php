<?php

namespace App\Services\Sms;

use App\Models\SmsSetting;
use Illuminate\Support\Facades\Log;

class Msg91Service
{
    protected string $authKey;
    protected int $route;
    protected string $senderId;
    protected string $dltEntityId;
    protected string $peId;
    protected string $country;

    public function __construct(SmsSetting $settings)
    {
        $this->authKey = $settings->msg91_auth_key ?? '';
        $this->route = (int) ($settings->msg91_route ?? 4);
        $this->senderId = $settings->sender_id ?? '';
        $this->dltEntityId = $settings->msg91_dlt_entity_id ?? '';
        $this->country = $settings->default_country_code ?? '91';
    }

    /**
     * Send a plain-text SMS via the webmingo GET API.
     *
     * @param  string|array  $to             Mobile number(s) with country code
     * @param  string        $message
     * @param  string|null   $dltTemplateId  Per-template DLT ID (overrides global entity ID)
     * @return array{success: bool, response: mixed}
     */
    public function send(string|array $to, string $message, ?string $dltTemplateId = null): array
    {
        // API accepts comma-separated mobiles
        $mobiles = is_array($to) ? implode(',', $to) : $to;

        $params = [
            'authkey' => $this->authKey,
            'mobiles' => $mobiles,
            'sender' => $this->senderId,
            'message' => urlencode($message),
            'route' => $this->route,
            'country' => $this->country,
        ];

        // PE_ID = your company entity ID from SmsSetting (always sent if configured)
        if ($this->dltEntityId) {
            $params['PE_ID'] = $this->dltEntityId;
        }

        // DLT_TE_ID = this specific template's registered ID from SmsTemplate
        if ($dltTemplateId) {
            $params['DLT_TE_ID'] = $dltTemplateId;
        }

        $url = 'http://sms.webmingo.in/api/sendhttp.php?' . http_build_query($params);

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);

            $response = curl_exec($ch);
            $curlErr = curl_error($ch);
            curl_close($ch);
            if ($curlErr) {
                Log::error('MSG91 cURL error', ['error' => $curlErr, 'mobile' => $mobiles]);
                return ['success' => false, 'response' => $curlErr];
                }
                
                // The webmingo API returns a numeric message ID on success, or an error string
                $isSuccess = $response !== false && trim($response) !== '';
                
            if (!$isSuccess) {
                Log::warning('MSG91 SMS failed', ['response' => $response, 'mobile' => $mobiles]);
            }

            return ['success' => $isSuccess, 'response' => $response];

        } catch (\Throwable $e) {
            Log::error('MSG91 SMS exception', ['error' => $e->getMessage(), 'mobile' => $mobiles]);
            return ['success' => false, 'response' => $e->getMessage()];
        }
    }

    /**
     * Send via MSG91's dedicated OTP API (v5).
     * Use this only if you want MSG91 to manage OTP generation natively.
     * For template-based OTP (current flow), use send() instead.
     */
    public function sendOtp(string $mobile, string $otp, string $templateId = '', int $otpExpiry = 10): array
    {
        $params = [
            'authkey' => $this->authKey,
            'mobile' => $mobile,
            'sender' => $this->senderId,
            'otp' => $otp,
            'otp_expiry' => $otpExpiry,
        ];

        if ($templateId) {
            $params['template_id'] = $templateId;
        }

        $url = 'https://api.msg91.com/api/v5/otp?' . http_build_query($params);

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);

            $response = curl_exec($ch);
            $curlErr = curl_error($ch);
            curl_close($ch);

            if ($curlErr) {
                Log::error('MSG91 OTP cURL error', ['error' => $curlErr]);
                return ['success' => false, 'response' => $curlErr];
            }

            $body = json_decode($response, true);
            $isSuccess = ($body['type'] ?? '') === 'success';

            if (!$isSuccess) {
                Log::warning('MSG91 OTP failed', ['body' => $body]);
            }

            return ['success' => $isSuccess, 'response' => $body ?? $response];

        } catch (\Throwable $e) {
            Log::error('MSG91 OTP exception', ['error' => $e->getMessage()]);
            return ['success' => false, 'response' => $e->getMessage()];
        }
    }
}