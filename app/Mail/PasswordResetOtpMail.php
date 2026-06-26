<?php

namespace App\Mail;

use App\Models\Customer;
use App\Models\Setting;
use App\Models\SmtpSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string  $customerEmail;
    public int     $otp;
    public string  $customerName;
    public mixed   $settings;
    public ?string $logoPath;

    public function __construct(string $email, int $otp, string $customerName = 'Valued Customer')
    {
        $this->customerEmail = $email;
        $this->otp           = $otp;
        $this->customerName  = $customerName;
    }

    public function build()
    {
        $this->settings = Setting::first();

        // ── Logo — same storage_path pattern as OrderShippedMail ──
        $logoPath = null;

        if ($this->settings?->logo) {
            $path = storage_path('app/public/' . $this->settings->logo);
            if (file_exists($path)) {
                $logoPath = $path;
            }
        }

        $siteName = $this->settings->site_name ?? config('app.name');

        $mail = $this
            ->subject("{$siteName} – Password Reset OTP")
            ->view('emails.password-reset-otp')
            ->with([
                'otp'          => $this->otp,
                'email'        => $this->customerEmail,
                'settings'     => $this->settings,
                'customerName' => $this->customerName,
                'logoPath'     => $logoPath,
            ]);

        // ── SMTP from / reply-to — same as OrderShippedMail ──
        $smtp = SmtpSetting::first();

        if ($smtp && !empty($smtp->reply_to_email)) {
            $mail->replyTo($smtp->reply_to_email, $smtp->reply_to_name);
        }

        if ($smtp && !empty($smtp->from_email)) {
            $mail->from($smtp->from_email, $smtp->from_name);
        }

        return $mail;
    }
}