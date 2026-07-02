<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmation – {{ $order->order_number }}</title>
  <style>
    /* ── Reset ── */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Georgia', serif;
      background-color: #e8eae6;
      color: #1a1a1a;
      -webkit-font-smoothing: antialiased;
    }

    /* ── Wrapper ── */
    .wrapper {
      max-width: 620px;
      margin: 30px auto;
      background: #ffffff;
      border-radius: 4px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(0,0,0,0.10);
    }

    /* ── Header ── */
    .email-header {
      background: #1F5552;
      text-align: center;
      padding: 32px 30px 28px;
      border-bottom: 3px solid #174743;
    }
    .email-header .brand {
      font-family: 'Georgia', serif;
      font-size: 22px;
      font-weight: 700;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: #f4f5f2;
      margin-top: 6px;
    }
    .email-header .tagline {
      font-size: 11px;
      color: #a8c4c2;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      margin-top: 5px;
    }

    /* ── Meta Bar ── */
    .meta-bar {
      display: table;
      width: 100%;
      background: #163e3c;
      border-bottom: 2px solid #0f2c2a;
    }
    .meta-cell {
      display: table-cell;
      padding: 14px 16px;
      text-align: center;
      border-right: 1px solid #1F5552;
      vertical-align: middle;
    }
    .meta-cell:last-child { border-right: none; }
    .meta-label {
      display: block;
      font-size: 9px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: #7ab0ad;
      margin-bottom: 3px;
    }
    .meta-value {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #f4f5f2;
    }

    /* ── Body ── */
    .body {
      padding: 36px 36px 28px;
      background: #ffffff;
    }
    .greeting {
      font-family: 'Georgia', serif;
      font-size: 16px;
      color: #1F5552;
      font-weight: 600;
      margin-bottom: 10px;
    }
    .intro {
      font-size: 13px;
      color: #555;
      line-height: 1.7;
      margin-bottom: 28px;
    }

    /* ── Section Title ── */
    .section-title {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #1F5552;
      border-bottom: 2px solid #1F5552;
      padding-bottom: 7px;
      margin-bottom: 16px;
    }

    /* ── Order Items ── */
    .item-row {
      display: table;
      width: 100%;
      border-bottom: 1px solid #e6eae9;
      padding: 14px 0;
    }
    .item-img-cell {
      display: table-cell;
      width: 60px;
      vertical-align: middle;
      padding-right: 14px;
    }
    .item-img {
      width: 56px;
      height: 56px;
      object-fit: cover;
      border-radius: 4px;
      border: 1px solid #d0d8d7;
    }
    .item-img-placeholder {
      display: block;
      width: 56px;
      height: 56px;
      background: #e8efee;
      border-radius: 4px;
      border: 1px solid #d0d8d7;
    }
    .item-detail-cell {
      display: table-cell;
      vertical-align: middle;
    }
    .item-name {
      font-size: 13px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 3px;
    }
    .item-meta {
      font-size: 11px;
      color: #7a9e9c;
    }
    .item-price-cell {
      display: table-cell;
      vertical-align: middle;
      text-align: right;
      font-size: 14px;
      font-weight: 700;
      color: #1F5552;
      white-space: nowrap;
    }

    /* ── Info Grid ── */
    .info-grid {
      display: table;
      width: 100%;
      margin-top: 8px;
    }
    .info-col {
      display: table-cell;
      width: 50%;
      padding-right: 16px;
      vertical-align: top;
    }
    .info-col:last-child { padding-right: 0; padding-left: 16px; }
    .info-box {
      background: #f4f5f2;
      border: 1px solid #d4dbd9;
      border-left: 3px solid #1F5552;
      border-radius: 3px;
      padding: 14px 16px;
      font-size: 12px;
      color: #444;
      line-height: 1.7;
    }
    .info-box strong {
      color: #1F5552;
      font-size: 13px;
      display: block;
      margin-bottom: 5px;
    }
    .info-box p { margin: 0; }

    /* ── CTA ── */
    .cta-section {
      text-align: center;
      margin: 32px 0 10px;
    }
    .cta-btn {
      display: inline-block;
      background: #1F5552;
      color: #f4f5f2 !important;
      text-decoration: none;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 14px 36px;
      border-radius: 2px;
    }

    /* ── Help Strip ── */
    .help-strip {
      background: #f4f5f2;
      border-top: 1px solid #d4dbd9;
      border-bottom: 1px solid #d4dbd9;
      text-align: center;
      padding: 20px 30px;
      font-size: 12px;
      color: #555;
      line-height: 1.7;
    }
    .help-strip a {
      color: #1F5552;
      font-weight: 600;
      text-decoration: none;
    }

    /* ── Footer ── */
    .email-footer {
      background: #1F5552;
      text-align: center;
      padding: 24px 30px;
    }
    .brand-footer {
      display: block;
      font-family: 'Georgia', serif;
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: #f4f5f2;
      margin-bottom: 12px;
    }
    .email-footer p {
      font-size: 11px;
      color: #7ab0ad;
      line-height: 1.8;
    }
    .email-footer a {
      color: #a8c4c2;
      text-decoration: none;
    }
  </style>
</head>

<body>

  <div class="wrapper">

    {{-- ── Header ── --}}
    <div class="email-header">

      @if(!empty($logoPath))
        <div style="background:#f4f5f2;display:inline-block;padding:10px 18px;border-radius:4px;margin-bottom:12px;">
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
    <div style="background: linear-gradient(135deg, #1F5552 0%, #2a6e6a 100%); padding: 40px; text-align: center;">
      <table cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto 14px auto;">
  <tr>
    <td width="54" height="54" align="center" valign="middle"
        style="width:54px;height:54px;background:#f4f5f2;border-radius:50%;">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#1F5552" stroke-width="2.5"
        stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
    </td>
  </tr>
</table>
      <h1
        style="font-family:'Georgia',serif;font-size:26px;font-weight:600;color:#f4f5f2;margin-bottom:6px;">
        Your order is confirmed!
      </h1>
      <p style="font-size:13px;color:#a8c4c2;line-height:1.6;">
        Thank you, {{ $order->customer_name }}. We've received your order and<br>
        our artisans are preparing your piece with care.
      </p>
    </div>

    {{-- ── Meta Bar ── --}}
    <div class="meta-bar">
      <div class="meta-cell">
        <span class="meta-label">Order No.</span>
        <span class="meta-value">{{ $order->order_number }}</span>
      </div>
      <div class="meta-cell">
        <span class="meta-label">Order Date</span>
        <span class="meta-value">{{ $order->created_at->format('d M Y') }}</span>
      </div>
      <div class="meta-cell">
        <span class="meta-label">Payment</span>
        <span class="meta-value">{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</span>
      </div>
      <div class="meta-cell">
        <span class="meta-label">Items</span>
        <span class="meta-value">{{ $order->items->count() }}</span>
      </div>
    </div>

    {{-- ── Body ── --}}
    <div class="body">

      <p class="greeting">Dear {{ $order->customer_name }},</p>
      <p class="intro">
        We're delighted to confirm your order at
        {{ $settings->site_name ?? config('app.name') }}.
        Each piece in our collection is crafted by skilled artisans and will be
        carefully packaged to reach you in perfect condition. You'll receive a
        shipping notification as soon as your order is dispatched.
      </p>

      {{-- ── Order Items ── --}}
      <div class="section-title">Order Summary</div>

      @foreach($order->items as $item)
        <div class="item-row">
          <div class="item-img-cell">
            @if(isset($productImages[$item->id]))
              <img src="{{ $message->embed($productImages[$item->id]) }}" alt="{{ $item->product_name }}" class="item-img">
            @else
              <span class="item-img-placeholder"></span>
            @endif
          </div>
          <div class="item-detail-cell">
            <div class="item-name">{{ $item->product_name }}</div>
            @if($item->product?->weight)
              <div class="item-meta">{{  $item->product?->weight }}ml</div>
            @endif
            <div class="item-meta">Qty: {{ $item->quantity }}</div>
          </div>
          <div class="item-price-cell">₹ {{ number_format($item->total, 2) }}</div>
        </div>
      @endforeach

      {{-- ── Totals ── --}}
      <div style="margin-top:16px;">

        <div style="display:table;width:100%;padding:5px 0;">
          <span style="display:table-cell;font-size:13px;color:#666;">Subtotal</span>
          <span style="display:table-cell;text-align:right;font-size:13px;color:#333;">
            ₹ {{ number_format($order->subtotal, 2) }}
          </span>
        </div>

        @if($order->discount > 0)
          <div style="display:table;width:100%;padding:5px 0;">
            <span style="display:table-cell;font-size:13px;color:#2e7d32;font-weight:500;">
              Discount @if($order->coupon_code)({{ $order->coupon_code }})@endif
            </span>
            <span style="display:table-cell;text-align:right;font-size:13px;color:#2e7d32;font-weight:500;">
              − ₹ {{ number_format($order->discount, 2) }}
            </span>
          </div>
        @endif

        @if($order->tax_amount > 0)
          @if($order->gst_type === 'igst')
            <div style="display:table;width:100%;padding:5px 0;">
              <span style="display:table-cell;font-size:13px;color:#666;">IGST ({{ $order->igst_rate }}%)</span>
              <span style="display:table-cell;text-align:right;font-size:13px;color:#333;">
                ₹ {{ number_format($order->igst_amount, 2) }}
              </span>
            </div>
          @else
            @if($order->cgst_amount > 0)
              <div style="display:table;width:100%;padding:5px 0;">
                <span style="display:table-cell;font-size:13px;color:#666;">CGST ({{ $order->cgst_rate }}%)</span>
                <span style="display:table-cell;text-align:right;font-size:13px;color:#333;">
                  ₹ {{ number_format($order->cgst_amount, 2) }}
                </span>
              </div>
            @endif
            @if($order->sgst_amount > 0)
              <div style="display:table;width:100%;padding:5px 0;">
                <span style="display:table-cell;font-size:13px;color:#666;">SGST ({{ $order->sgst_rate }}%)</span>
                <span style="display:table-cell;text-align:right;font-size:13px;color:#333;">
                  ₹ {{ number_format($order->sgst_amount, 2) }}
                </span>
              </div>
            @endif
          @endif
        @endif

        <hr style="border:none;border-top:1px solid #d4dbd9;margin:10px 0;">

        <div style="display:table;width:100%;padding:5px 0;">
          <span style="display:table-cell;font-size:15px;font-weight:600;color:#1a1a1a;">Grand Total</span>
          <span style="display:table-cell;text-align:right;font-size:16px;font-weight:700;color:#1F5552;">
            ₹ {{ number_format($order->grand_total, 2) }}
          </span>
        </div>

      </div>

      {{-- ── Delivery Address + Payment ── --}}
      <div class="info-grid">
        <div class="info-col">
          <div class="section-title" style="margin-top:24px;">Delivery Address</div>
          <div class="info-box">
            <strong>{{ $order->customer_name }}</strong>
            <p>
              {{ $order->address_line_1 }}
              @if($order->address_line_2), {{ $order->address_line_2 }}@endif<br>
              {{ $order->city?->name }}, {{ $order->state?->name }} – {{ $order->pincode }}<br>
              📞 {{ $order->customer_phone }}
            </p>
          </div>
        </div>

        <div class="info-col">
          <div class="section-title" style="margin-top:24px;">Payment Info</div>
          <div class="info-box">
            <strong>{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</strong>
            <p>
              Status:
              @php
                $badges = [
                  'paid' => ['label' => 'Paid', 'color' => '#2e7d32'],
                  'pending' => ['label' => 'Pending', 'color' => '#f57f17'],
                  'cod' => ['label' => 'Pay on Delivery', 'color' => '#1565c0'],
                  'failed' => ['label' => 'Failed', 'color' => '#c62828'],
                ];
                $badge = $badges[$order->payment_status] ?? ['label' => ucfirst($order->payment_status), 'color' => '#f57f17'];
              @endphp
              <span style="font-weight:600;color:{{ $badge['color'] }};">
                {{ $badge['label'] }}
              </span>
            </p>
            @if($order->transaction_id)
              <p style="margin-top:6px;font-size:11px;color:#aaa;">
                Txn: {{ $order->transaction_id }}
              </p>
            @endif
          </div>
        </div>
      </div>

      {{-- ── CTA ── --}}
      <div class="cta-section">
        <a href="{{ url('/user/orders/' . $order->id) }}" class="cta-btn">
          View Order Details
        </a>
      </div>

    </div>

    {{-- ── Help Strip ── --}}
    <div class="help-strip">
      <p>
        Questions about your order? We're happy to help.<br>

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
        <a href="{{ url('/unsubscribe') }}">Unsubscribe</a> &nbsp;·&nbsp;
        <a href="{{ url('/privacy') }}">Privacy Policy</a>
      </p>
      <p style="margin-top:8px;">
        © {{ date('Y') }} {{ $settings->site_name ?? config('app.name') }}. All rights reserved.
      </p>
    </div>

  </div>

</body>

</html>