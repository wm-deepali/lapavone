<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #LP-2026-9824 | La Pavone</title>
    <meta name="description" content="View or print your order invoice from La Pavone.">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts: Cinzel for Luxury Headings & Outfit for UI -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
       <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="la-pavone-wrapper invoice-page-wrapper">
        <div class="invoice-actions">
            <button class="lp-btn lp-btn-outline" onclick="window.history.back()">
                <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Back
            </button>
            <button class="lp-btn lp-btn-solid" onclick="window.print()">
                <i class="fa-solid fa-print" style="margin-right: 8px;"></i> Print Invoice
            </button>
        </div>

        <div class="invoice-container">
            <div class="invoice-header">
                <div class="invoice-brand">
                    <img src="assets/images/logo.png" alt="La Pavone">
                </div>
                <div class="invoice-title">
                    <h1>INVOICE</h1>
                    <p>Reference: #LP-2026-9824</p>
                </div>
            </div>

            <div class="invoice-meta">
                <div class="invoice-meta-col">
                    <h3>Billed To</h3>
                    <p>
                        Bilal Khilji<br>
                        A-152, Bhagat Singh Colony<br>
                        Bhiwadi, Rajasthan 301019<br>
                        India<br>
                        T: +91 98765 43210
                    </p>
                </div>
                <div class="invoice-meta-col">
                    <h3>Shipped To</h3>
                    <p>
                        Bilal Khilji<br>
                        A-152, Bhagat Singh Colony<br>
                        Bhiwadi, Rajasthan 301019<br>
                        India<br>
                        T: +91 98765 43210
                    </p>
                </div>
                <div class="invoice-meta-col">
                    <h3>Order Details</h3>
                    <p>
                        <strong>Order Date:</strong> June 15, 2026<br>
                        <strong>Invoice Date:</strong> June 15, 2026<br>
                        <strong>Payment Method:</strong> Credit Card (Visa ending in 4242)<br>
                        <strong>Shipping Method:</strong> Standard Express
                    </p>
                </div>
            </div>

            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Item Description</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-right">Unit Price</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Item Description">
                            <strong>Noir Emir</strong><br>
                            <span style="font-size: 13px; color: #888;">100ml Eau De Parfum</span>
                        </td>
                        <td data-label="Quantity" class="text-center">1</td>
                        <td data-label="Unit Price" class="text-right">₹3,299.00</td>
                        <td data-label="Total" class="text-right">₹3,299.00</td>
                    </tr>
                    <tr>
                        <td data-label="Item Description">
                            <strong>Rosea</strong><br>
                            <span style="font-size: 13px; color: #888;">100ml Eau De Parfum</span>
                        </td>
                        <td data-label="Quantity" class="text-center">1</td>
                        <td data-label="Unit Price" class="text-right">₹3,299.00</td>
                        <td data-label="Total" class="text-right">₹3,299.00</td>
                    </tr>
                </tbody>
            </table>

            <div class="invoice-totals">
                <div class="invoice-totals-row">
                    <span>Subtotal</span>
                    <span>₹6,598.00</span>
                </div>
                <div class="invoice-totals-row">
                    <span>Shipping</span>
                    <span>₹0.00</span>
                </div>
                <div class="invoice-totals-row">
                    <span>Tax (18% GST Inc.)</span>
                    <span>₹1,006.47</span>
                </div>
                <div class="invoice-totals-row grand-total">
                    <span>Total Paid</span>
                    <span>₹6,598.00</span>
                </div>
            </div>

            <div class="invoice-footer">
                <h3>Thank you for your purchase</h3>
                <p>If you have any questions about this invoice, please contact support@lapavone.com</p>
            </div>
        </div>
    </div>
</body>

</html>
