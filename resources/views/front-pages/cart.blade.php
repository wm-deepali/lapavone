@extends('layouts.app')
@section('content')

   <div class="cart-page-wrapper">

    <section class="cart-section" style="padding: 80px 0; background-color: #FAFAF8;">
            <div class="lp-container">
                <div class="cart-header text-center" style="margin-bottom: 48px;">
                    <h1 class="cart-title" style="font-family: 'Cinzel', serif; color: #1F5552; font-size: 36px; letter-spacing: 2px;">YOUR CART</h1>
                    <p class="cart-subtitle" style="font-family: 'Outfit', sans-serif; color: #666; font-size: 16px; margin-top: 8px;">Review your luxury selections.</p>
                </div>

                <div class="row g-5">
                    <!-- Cart Items -->
                    <div class="col-lg-8">
                        <div class="cart-items-container">
                            
                            <!-- Cart Item Header -->
                            <div class="cart-item-header d-none d-md-flex">
                                <div class="col-product">Product</div>
                                <div class="col-qty">Quantity</div>
                                <div class="col-total">Total</div>
                            </div>

                            <!-- Cart Item 1 -->
                            <div class="cart-item">
                                <div class="cart-item-product">
                                    <div class="cart-item-img">
                                        <img src="assets/images/products/best_seller_1.png" alt="Reign">
                                    </div>
                                    <div class="cart-item-details">
                                        <h3 class="cart-item-name">Reign</h3>
                                        <p class="cart-item-type">Signature Collection</p>
                                        <p class="cart-item-price d-md-none">₹3,999</p>
                                    </div>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="quantity-selector">
                                        <button class="qty-btn minus">-</button>
                                        <input type="number" class="qty-input" value="1" min="1">
                                        <button class="qty-btn plus">+</button>
                                    </div>
                                    <button class="cart-item-remove d-md-none" aria-label="Remove item">Remove</button>
                                </div>
                                <div class="cart-item-total">
                                    <span>₹3,999</span>
                                    <button class="cart-item-remove-icon d-none d-md-block" aria-label="Remove item"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                            
                            <!-- Cart Item 2 -->
                            <div class="cart-item">
                                <div class="cart-item-product">
                                    <div class="cart-item-img">
                                        <img src="assets/images/products/best_seller_2.png" alt="Rosea">
                                    </div>
                                    <div class="cart-item-details">
                                        <h3 class="cart-item-name">Rosea</h3>
                                        <p class="cart-item-type">Floral Collection</p>
                                        <p class="cart-item-price d-md-none">₹3,999</p>
                                    </div>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="quantity-selector">
                                        <button class="qty-btn minus">-</button>
                                        <input type="number" class="qty-input" value="2" min="1">
                                        <button class="qty-btn plus">+</button>
                                    </div>
                                    <button class="cart-item-remove d-md-none" aria-label="Remove item">Remove</button>
                                </div>
                                <div class="cart-item-total">
                                    <span>₹7,998</span>
                                    <button class="cart-item-remove-icon d-none d-md-block" aria-label="Remove item"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-4">
                        <div class="cart-summary-card">
                            <h3 class="summary-title">ORDER SUMMARY</h3>
                            <div class="summary-line">
                                <span>Subtotal</span>
                                <span>₹11,997</span>
                            </div>
                            <div class="summary-line">
                                <span>Shipping</span>
                                <span>Free</span>
                            </div>
                            <div class="summary-line">
                                <span>Taxes</span>
                                <span>Calculated at checkout</span>
                            </div>
                            <hr class="summary-divider">
                            <div class="summary-line total-line">
                                <span>Total</span>
                                <span>₹11,997</span>
                            </div>
                            <button class="lp-btn lp-btn-solid checkout-btn" style="width: 100%; margin-top: 24px; padding: 14px; font-size: 16px;">PROCEED TO CHECKOUT</button>
                            <p class="secure-checkout"><i class="fa-solid fa-lock"></i> Secure Checkout</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

   </div>

@endsection