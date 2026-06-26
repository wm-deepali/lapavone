<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset OTP</title>
  @include('emails.partials.order-email-base')
</head>

<body>

  <div class="wrapper">

    {{-- ── Header ── --}}
    <div class="email-header">

      @if(!empty($logoPath))
        <div style="background:#ffffff;display:inline-block;padding:12px 20px;border-radius:8px;margin-bottom:15px;">
          <img src="{{ $message->embed($logoPath) }}" alt="{{ $settings->site_name }}"
            style="max-height:70px;max-width:220px;">
        </div>
      @endif

      <div class="brand">
        {{ $settings->site_name ?? config('app.name') }}
      </div>

      @if(!empty($settings->tagline))
        <div class="tagline">{{ $settings->tagline }}</div>
      @endif

    </div>

    {{-- ── Hero ── --}}
    <div style="background: linear-gradient(135deg, #2c1f14 0%, #4a3728 100%); padding: 40px; text-align: center;">
      <div
        style="width:54px;height:54px;background:#d4af7a;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin-bottom:14px;">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="2.5"
          stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
      </div>
      <h1
        style="font-family:'Playfair Display',Georgia,serif;font-size:26px;font-weight:600;color:#f5f0e8;margin-bottom:6px;">
        Password Reset Request
      </h1>
      <p style="font-size:13px;color:#c4b49a;line-height:1.6;">
        We received a request to reset your password.<br>
        Use the OTP below to proceed.
      </p>
    </div>

    {{-- ── Body ── --}}
    <div class="body">

      <p class="greeting">Dear {{ $customerName }},</p>
      <p class="intro">
        Someone (hopefully you) requested a password reset for your account at
        {{ $settings->site_name ?? config('app.name') }}.
        Enter the one-time password below to continue. If you did not request this,
        you can safely ignore this email — your password will remain unchanged.
      </p>

      {{-- ── OTP Box ── --}}
      <div style="text-align:center; margin: 32px 0;">
        <div style="display:inline-block; background:#f9f5ef; border:1px solid #e8ddd0; border-radius:12px; padding:24px 40px;">
          <p style="font-size:12px; color:#999; margin:0 0 8px; letter-spacing:1px; text-transform:uppercase;">
            Your One-Time Password
          </p>
          <div style="font-family:'Playfair Display',Georgia,serif; font-size:42px; font-weight:700; letter-spacing:10px; color:#b08d57;">
            {{ $otp }}
          </div>
          <p style="font-size:12px; color:#aaa; margin:10px 0 0;">
            Valid for <strong style="color:#666;">10 minutes</strong> &nbsp;·&nbsp; Do not share this with anyone
          </p>
        </div>
      </div>

      {{-- ── Security note ── --}}
      <div style="background:#fff8f0; border-left:3px solid #d4af7a; border-radius:4px; padding:14px 18px; margin:24px 0;">
        <p style="font-size:13px; color:#7a5c3a; margin:0; line-height:1.7;">
          <strong>Security tip:</strong> {{ $settings->site_name ?? config('app.name') }} will never ask for
          your OTP over phone or chat. If anyone contacts you requesting this code, please ignore them.
        </p>
      </div>

      {{-- ── Divider ── --}}
      <hr style="border:none; border-top:1px solid #ede8e0; margin:28px 0;">

      <p style="font-size:12px; color:#aaa; text-align:center; line-height:1.8;">
        This email was sent to <strong style="color:#888;">{{ $email }}</strong> because a password reset was requested.<br>
        If this wasn't you, no action is needed — your account is safe.
      </p>

    </div>

    {{-- ── Help Strip ── --}}
    <div class="help-strip">
      <p>
        Need help? We're here for you.<br>

        @if($settings?->support_email)
          Email us at
          <a href="mailto:{{ $settings->support_email }}">{{ $settings->support_email }}</a>
        @endif

        @if($settings?->phone)
          <br>Call us at
          <a href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a>
        @endif
      </p>
    </div>

    {{-- ── Footer ── --}}
    <div class="email-footer">
      <span class="brand-footer">{{ $settings->site_name ?? config('app.name') }}</span>
      <p>
        <a href="{{ url('/privacy') }}">Privacy Policy</a>
      </p>
      <p style="margin-top:8px;">
        © {{ date('Y') }} {{ $settings->site_name ?? config('app.name') }}. All rights reserved.
      </p>
    </div>

  </div>

</body>

</html>