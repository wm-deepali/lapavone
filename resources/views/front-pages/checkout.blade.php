@extends('layouts.app')
@section('content')

    <div class="checkout-page-wrapper">

        <section class="checkout-section" style="padding: 80px 0; background-color: #FAFAF8;">
            <div class="lp-container">
                <div class="checkout-header text-center" style="margin-bottom: 48px;">
                    <h1 class="checkout-title"
                        style="font-family: 'Cinzel', serif; color: #1F5552; font-size: 36px; letter-spacing: 2px;">
                        CHECKOUT</h1>
                    <p class="checkout-subtitle"
                        style="font-family: 'Outfit', sans-serif; color: #666; font-size: 16px; margin-top: 8px;">
                        Complete your purchase securely.</p>
                </div>

                <div class="row g-5">
                    <!-- Left Column: Forms -->
                    <div class="col-lg-7">
                        <div class="checkout-form-container">
                            <!-- Contact Info -->
                            <div class="checkout-section-block">
                                <h2 class="checkout-section-title">Contact Information</h2>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="newsOffers" checked>
                                    <label class="form-check-label" for="newsOffers">
                                        Email me with news and exclusive offers
                                    </label>
                                </div>
                            </div>

                            <!-- Shipping Address -->
                            <div class="checkout-section-block mt-5">
                                <h2 class="checkout-section-title" style="margin-bottom: 24px;">Shipping Address</h2>

                                <!-- Address Cards Row -->
                                <div class="address-cards-row mb-4">
                                    <div class="row g-3">
                                        <!-- Add New Address Card -->
                                        <div class="col-md-4">
                                            <div class="address-card add-new-card" id="card-new-address">
                                                <div class="add-new-content">
                                                    <span class="plus-icon">+</span>
                                                    <span class="add-text">Add New Address</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Default Address Card -->
                                        <div class="col-md-4">
                                            <div class="address-card existing-address-card active"
                                                id="card-default-address">
                                                <span class="default-badge">DEFAULT SHIPPING</span>
                                                <div>
                                                    <h3 class="address-name">Bilal Khilji</h3>
                                                    <p class="address-details-text">
                                                        A-152, Bhagat Singh Colony<br>
                                                        Near Central Park<br>
                                                        Bhiwadi, Rajasthan 301019<br>
                                                        India
                                                    </p>
                                                    <p class="address-phone-text">Phone: +91 98765 43210</p>
                                                </div>
                                                <div>
                                                    <hr class="card-divider">
                                                    <div class="card-actions">
                                                        <a href="#" class="action-edit">Edit</a>
                                                        <a href="#" class="action-delete">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Office Address Card -->
                                        <div class="col-md-4">
                                            <div class="address-card existing-address-card" id="card-office-address">
                                                <div>
                                                    <h3 class="address-name">Bilal Khilji (Office)</h3>
                                                    <p class="address-details-text">
                                                        Tech Park Tower B, 4th Floor<br>
                                                        Sector 45<br>
                                                        Gurugram, Haryana 122003<br>
                                                        India
                                                    </p>
                                                    <p class="address-phone-text">Phone: +91 99887 76655</p>
                                                </div>
                                                <div>
                                                    <hr class="card-divider">
                                                    <div class="card-actions">
                                                        <a href="#" class="action-edit">Edit</a>
                                                        <a href="#" class="action-default-set">Set as Default</a>
                                                        <a href="#" class="action-delete">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- New Address Input Form (Hidden by default when existing card is active) -->
                                <div class="row g-3" id="shipping-form-fields" style="display: none;">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Last Name">
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" placeholder="Address">
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control"
                                            placeholder="Apartment, suite, etc. (optional)">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="City">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select">
                                            <option selected disabled>State</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Karnataka">Karnataka</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="PIN Code">
                                    </div>
                                    <div class="col-12">
                                        <input type="tel" class="form-control" placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Options -->
                            <!-- <div class="checkout-section-block mt-5">
                                    <h2 class="checkout-section-title">Payment</h2>
                                    <p class="text-muted" style="font-family: 'Outfit', sans-serif; font-size: 14px;">All
                                        transactions are secure and encrypted.</p>
                                    <div class="payment-methods-box">
                                        <div class="payment-option border-bottom">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    id="creditCard" checked>
                                                <label class="form-check-label fw-bold" for="creditCard">
                                                    Credit Card / Debit Card
                                                </label>
                                            </div>
                                            <div class="payment-details mt-3">
                                                <input type="text" class="form-control mb-3" placeholder="Card Number">
                                                <input type="text" class="form-control mb-3" placeholder="Name on Card">
                                                <div class="row g-3">
                                                    <div class="col-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="Expiration date (MM/YY)">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="Security code (CVV)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment-option border-bottom">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="paymentMethod" id="upi">
                                                <label class="form-check-label fw-bold" for="upi">
                                                    UPI (GPay, PhonePe, Paytm)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="payment-option border-bottom">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    id="paypal">
                                                <label class="form-check-label fw-bold" for="paypal">
                                                    PayPal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="payment-option">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="paymentMethod" id="cod">
                                                <label class="form-check-label fw-bold" for="cod">
                                                    Cash on Delivery (COD)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                        </div>
                    </div>

                    <!-- Right Column: Order Summary -->
                    <div class="col-lg-5">
                        <div class="checkout-summary-card">

                            <!-- Items -->
                            <div class="checkout-item">
                                <div class="checkout-item-img">
                                    <img src="assets/images/products/best_seller_1.png" alt="Reign">
                                    <span class="checkout-item-badge">1</span>
                                </div>
                                <div class="checkout-item-details">
                                    <h3 class="checkout-item-name">Reign</h3>
                                    <p class="checkout-item-type">Signature Collection</p>
                                </div>
                                <div class="checkout-item-price">₹3,999</div>
                            </div>

                            <div class="checkout-item">
                                <div class="checkout-item-img">
                                    <img src="assets/images/products/best_seller_2.png" alt="Rosea">
                                    <span class="checkout-item-badge">2</span>
                                </div>
                                <div class="checkout-item-details">
                                    <h3 class="checkout-item-name">Rosea</h3>
                                    <p class="checkout-item-type">Floral Collection</p>
                                </div>
                                <div class="checkout-item-price">₹7,998</div>
                            </div>

                            <hr class="checkout-divider">

                            <!-- Discount Code -->
                            <div class="mb-4">
                                <div class="d-flex gap-2">
                                    <input type="text" id="discount-input" class="form-control" placeholder="Discount code"
                                        style="border: 1px solid rgba(35, 75, 70, 0.2); border-radius: 8px; font-family: 'Outfit', sans-serif; padding: 12px 16px; font-size: 14px;">
                                    <button class="lp-btn" id="apply-coupon-btn">Apply</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2 px-1">
                                    <span id="coupon-message"
                                        style="font-family: 'Outfit', sans-serif; font-size: 13px; font-weight: 500; display: none;"></span>
                                    <a href="#" id="view-coupons-link" data-bs-toggle="modal"
                                        data-bs-target="#couponsModal">View All Coupons</a>
                                </div>
                            </div>

                            <hr class="checkout-divider">

                            <!-- Totals -->
                            <div class="summary-line">
                                <span>Subtotal</span>
                                <span id="subtotal-val">₹11,997</span>
                            </div>
                            <div class="summary-line">
                                <span>Shipping</span>
                                <span>Free</span>
                            </div>
                            <div class="summary-line">
                                <span>Taxes (18% GST Included)</span>
                                <span id="taxes-val">₹1,830</span>
                            </div>
                            <div class="summary-line coupon-applied-row" id="discount-row" style="display: none;">
                                <span>Discount (<span id="discount-code-label"></span>) <a href="#" id="remove-coupon-btn"
                                        style="color: #dc3545; font-size: 11px; margin-left: 6px; text-decoration: underline;">Remove</a></span>
                                <span>-₹<span id="discount-val">0</span></span>
                            </div>
                            <hr class="checkout-divider">
                            <div class="summary-line total-line" style="font-size: 20px; color: #1F5552;">
                                <span>Total</span>
                                <span class="fw-bold" id="total-val">₹11,997</span>
                            </div>
                            <button class="lp-btn lp-btn-solid w-100 mt-4" style="padding: 16px; font-size: 16px;"
                                onclick="window.location.href='order-details.html'">COMPLETE ORDER</button>
                            <p class="secure-checkout mt-3 text-center"><i class="fa-solid fa-lock"></i> Secure
                                Encrypted Checkout</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Coupons Modal -->
        <div class="modal fade" id="couponsModal" tabindex="-1" aria-labelledby="couponsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="couponsModalLabel"
                            style="font-family: 'Cinzel', serif; color: #1F5552; font-weight: 600; letter-spacing: 1px; font-size: 20px;">
                            AVAILABLE COUPONS</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Coupon Card 1 -->
                        <div class="coupon-card mb-3">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="coupon-badge">PAVONE15</span>
                                <button class="btn-use-coupon" data-code="PAVONE15">USE COUPON</button>
                            </div>
                            <div style="font-family: 'Outfit', sans-serif; font-size: 13px; color: #666; line-height: 1.4;">
                                Get <strong>15% OFF</strong> on all luxury collections. Experience our signature scents with
                                an exclusive discount.
                            </div>
                        </div>

                        <!-- Coupon Card 2 -->
                        <div class="coupon-card mb-3">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="coupon-badge">GOLDENHOUR</span>
                                <button class="btn-use-coupon" data-code="GOLDENHOUR">USE COUPON</button>
                            </div>
                            <div style="font-family: 'Outfit', sans-serif; font-size: 13px; color: #666; line-height: 1.4;">
                                Get flat <strong>₹1,000 OFF</strong> on a minimum order of ₹5,000. Perfect for warm,
                                aromatic selections.
                            </div>
                        </div>

                        <!-- Coupon Card 3 -->
                        <div class="coupon-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="coupon-badge">LUPAVONE5</span>
                                <button class="btn-use-coupon" data-code="LUPAVONE5">USE COUPON</button>
                            </div>
                            <div style="font-family: 'Outfit', sans-serif; font-size: 13px; color: #666; line-height: 1.4;">
                                Enjoy flat <strong>5% OFF</strong> on any order size. A small token from La Pavone.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


        <script>
        document.addEventListener('DOMContentLoaded', () => {
            // DOM Elements
            const discountInput = document.getElementById('discount-input');
            const applyCouponBtn = document.getElementById('apply-coupon-btn');
            const couponMessage = document.getElementById('coupon-message');
            const discountRow = document.getElementById('discount-row');
            const discountCodeLabel = document.getElementById('discount-code-label');
            const discountValEl = document.getElementById('discount-val');
            const totalValEl = document.getElementById('total-val');
            const removeCouponBtn = document.getElementById('remove-coupon-btn');
            const taxesValEl = document.getElementById('taxes-val');

            // Original Values
            const subtotal = 11997; // parsed from static text
            
            // Available coupons definition
            const coupons = {
                'PAVONE15': {
                    type: 'percent',
                    value: 15,
                    description: '15% OFF on all luxury collections'
                },
                'GOLDENHOUR': {
                    type: 'flat',
                    value: 1000,
                    description: 'Flat ₹1,000 OFF on orders above ₹5,000'
                },
                'LUPAVONE5': {
                    type: 'percent',
                    value: 5,
                    description: 'Flat 5% OFF on order size'
                }
            };

            // Coupon apply logic
            function applyCoupon(code) {
                if (!code) {
                    showMessage('Please enter a coupon code.', 'error');
                    return;
                }

                const coupon = coupons[code];

                if (coupon) {
                    let discountAmount = 0;
                    if (coupon.type === 'percent') {
                        discountAmount = Math.round(subtotal * (coupon.value / 100));
                    } else if (coupon.type === 'flat') {
                        discountAmount = coupon.value;
                    }

                    const finalTotal = subtotal - discountAmount;
                    const finalTax = Math.round(finalTotal * 18 / 118);

                    // Update UI values
                    discountCodeLabel.textContent = code;
                    discountValEl.textContent = discountAmount.toLocaleString('en-IN');
                    totalValEl.textContent = '₹' + finalTotal.toLocaleString('en-IN');
                    if (taxesValEl) {
                        taxesValEl.textContent = '₹' + finalTax.toLocaleString('en-IN');
                    }

                    // Show elements
                    discountRow.style.display = 'flex';
                    showMessage(`Coupon "${code}" applied successfully!`, 'success');
                } else {
                    showMessage('Invalid coupon code.', 'error');
                    // Reset summary UI
                    discountRow.style.display = 'none';
                    totalValEl.textContent = '₹' + subtotal.toLocaleString('en-IN');
                    if (taxesValEl) {
                        const originalTax = Math.round(subtotal * 18 / 118);
                        taxesValEl.textContent = '₹' + originalTax.toLocaleString('en-IN');
                    }
                }
            }

            // Remove Coupon function
            function removeCoupon() {
                discountInput.value = '';
                discountRow.style.display = 'none';
                totalValEl.textContent = '₹' + subtotal.toLocaleString('en-IN');
                if (taxesValEl) {
                    const originalTax = Math.round(subtotal * 18 / 118);
                    taxesValEl.textContent = '₹' + originalTax.toLocaleString('en-IN');
                }
                couponMessage.style.display = 'none';
            }

            // Show success/error message
            function showMessage(text, type) {
                couponMessage.textContent = text;
                couponMessage.style.display = 'block';
                if (type === 'success') {
                    couponMessage.style.color = '#2e7d32'; // Green
                } else {
                    couponMessage.style.color = '#c62828'; // Red
                }
            }

            // Event Listeners for USE COUPON buttons in modal
            document.querySelectorAll('.btn-use-coupon').forEach(btn => {
                btn.addEventListener('click', () => {
                    const code = btn.getAttribute('data-code');
                    discountInput.value = code;

                    // Apply coupon
                    applyCoupon(code);

                    // Close Modal using Bootstrap API
                    const modalEl = document.getElementById('couponsModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                });
            });

            // Event Listener for manual Apply click
            if (applyCouponBtn) {
                applyCouponBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const code = discountInput.value.trim().toUpperCase();
                    applyCoupon(code);
                });
            }

            // Event Listener for Coupon Code input keypress (Enter)
            if (discountInput) {
                discountInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const code = discountInput.value.trim().toUpperCase();
                        applyCoupon(code);
                    }
                });
            }

            // Event Listener for Remove link
            if (removeCouponBtn) {
                removeCouponBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    removeCoupon();
                });
            }

            // --- Shipping Address Card Selection Logic ---
            const cardNewAddress = document.getElementById('card-new-address');
            const existingAddressCards = document.querySelectorAll('.existing-address-card');
            const shippingFormFields = document.getElementById('shipping-form-fields');

            if (cardNewAddress && shippingFormFields) {
                // Click Add New Address Card
                cardNewAddress.addEventListener('click', () => {
                    document.querySelectorAll('.address-card').forEach(c => c.classList.remove('active'));
                    cardNewAddress.classList.add('active');
                    
                    // Show custom address form fields
                    shippingFormFields.style.display = 'flex';
                });
            }

            existingAddressCards.forEach(card => {
                card.addEventListener('click', (e) => {
                    // Prevent card action buttons from triggering selection
                    if (e.target.tagName === 'A') return;

                    document.querySelectorAll('.address-card').forEach(c => c.classList.remove('active'));
                    card.classList.add('active');

                    // Hide custom address form fields
                    if (shippingFormFields) {
                        shippingFormFields.style.display = 'none';
                    }
                });
            });
        });
    </script>
    
@endsection