<body>

<div class="wrapper">

    <div class="email-header">

        <div style="background:#f4f5f2;display:inline-block;padding:10px 18px;border-radius:4px;margin-bottom:12px;">
            <img src="{logo_url}" alt="{brand_name}" style="max-height:70px;max-width:220px;">
        </div>

        <div class="brand">{store_name}</div>

        <div class="tagline">{tagline}</div>

    </div>

    <div style="background: linear-gradient(135deg, #1F5552 0%, #2a6e6a 100%); padding: 40px; text-align: center;">

        <table cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto 14px auto;">
            <tr>
                <td width="54" height="54" align="center" valign="middle"
                    style="width:54px;height:54px;background:#f4f5f2;border-radius:50%;">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#1F5552" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13" rx="1"></rect>
                        <path d="M16 8h4l3 5v3h-7V8z"></path>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                </td>
            </tr>
        </table>

        <h1 style="font-family:'Georgia',serif;font-size:24px;font-weight:600;color:#f4f5f2;margin-bottom:6px;">
            Your order is on its way!
        </h1>

        <p style="font-size:13px;color:#a8c4c2;">
            Your package has been handed over to the courier<br>
            and is heading to you now.
        </p>

    </div>

    <div class="meta-bar">

        <div class="meta-cell">
            <span class="meta-label">Order No.</span>
            <span class="meta-value">{order_number}</span>
        </div>

        <div class="meta-cell">
            <span class="meta-label">Shipped On</span>
            <span class="meta-value">{shipped_date}</span>
        </div>

        <div class="meta-cell">
            <span class="meta-label">Courier</span>
            <span class="meta-value">{courier_name}</span>
        </div>

        <div class="meta-cell">
            <span class="meta-label">Tracking No.</span>
            <span class="meta-value">{tracking_number}</span>
        </div>

    </div>

    <div class="body">

        <p class="greeting">Dear {customer_name},</p>

        <p class="intro">
            Great news! Your {store_name} order has been dispatched and is on its way to you.
            Our artisans have carefully packaged your piece to ensure it arrives in
            perfect condition. Please allow the estimated delivery time as per your
            location before reaching out to us.
        </p>

        <div style="background:#f4f5f2;border:1px solid #d4dbd9;border-left:3px solid #1F5552;border-radius:3px;padding:18px 20px;margin-bottom:28px;">

            <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.12em;color:#1F5552;font-weight:700;margin-bottom:10px;">
                Tracking Information
            </div>

            <div style="display:table;width:100%;">

                <div style="display:table-cell;vertical-align:middle;">
                    <div style="font-size:13px;font-weight:600;color:#1a1a1a;">
                        {courier_name}
                    </div>

                    <div style="font-size:13px;color:#1F5552;font-weight:600;margin-top:3px;font-family:'Courier New',monospace;">
                        {tracking_number}
                    </div>
                </div>

                <div style="display:table-cell;vertical-align:middle;text-align:right;">
                    <a href="{tracking_url}" target="_blank"
                        style="display:inline-block;background:#1F5552;color:#f4f5f2 !important;text-decoration:none;font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;padding:10px 18px;border-radius:2px;">
                        Track Package
                    </a>
                </div>

            </div>

        </div>

        <div class="section-title">Items In Your Shipment</div>

        {order_items}

        <div class="info-grid">

            <div class="info-col">

                <div class="section-title" style="margin-top:20px;">
                    Delivering To
                </div>

                <div class="info-box">
                    {shipping_address}
                </div>

            </div>

            <div class="info-col">

                <div class="section-title" style="margin-top:20px;">
                    Order Total
                </div>

                <div class="info-box">

                    <strong style="font-size:20px;color:#1F5552;">
                        {grand_total}
                    </strong>

                    <p style="margin-top:6px;">
                        Payment: {payment_method}<br>
                        Status: {payment_status}
                    </p>

                    <p style="margin-top:6px;">
                        Expected Delivery: {expected_delivery}
                    </p>

                </div>

            </div>

        </div>

        <div class="cta-section">
            <a href="{order_url}" class="cta-btn">
                View Order Details
            </a>
        </div>

    </div>

    <div class="help-strip">
        <p>
            Need help with your shipment?<br>

            Email us at
            <a href="mailto:{support_email}">
                {support_email}
            </a>

            <br>

            Call us at
            <a href="tel:{support_number}">
                {support_number}
            </a>
        </p>
    </div>

    <div class="email-footer">

        <span class="brand-footer">
            {store_name}
        </span>

        <p>
            <a href="{order_url}" style="color:#a8c4c2;text-decoration:none;">
                View Order
            </a>
        </p>

        <p style="margin-top:8px;">
            © {brand_name}. All rights reserved.
        </p>

    </div>

</div>

</body>