@extends('layouts.app')
@section('content')

    <div class="dashboard-page-wrapper">

    <section class="dashboard-section">
            <div class="lp-container">
                <div class="dashboard-layout">
                    <!-- Dashboard Sidebar -->
                    <aside class="dashboard-sidebar">
                        <div class="user-profile-header">
                            <h2 class="user-name">Bilal Khilji</h2>
                            <p class="user-member-since">Member since 2026</p>
                        </div>
                        <nav class="dashboard-nav">
                            <a href="orders.html" class="dashboard-nav-item active">
                                <img src="assets/images/dashbord_oder.png" alt="Orders">
                                <span>Orders</span>
                            </a>
                            <a href="wishlist.html" class="dashboard-nav-item">
                                <img src="assets/images/dashbord_wishlist.png" alt="Wishlist">
                                <span>Wishlist</span>
                            </a>
                            <a href="addresses.html" class="dashboard-nav-item">
                                <img src="assets/images/dashbord_location.png" alt="Addresses">
                                <span>Addresses</span>
                            </a>
                            <a href="profile.html" class="dashboard-nav-item">
                                <img src="assets/images/dashbord_profile.png" alt="Profile">
                                <span>Profile</span>
                            </a>
                            <hr class="dashboard-nav-divider">
                            <a href="#" class="dashboard-nav-item logout-item">
                                <img src="assets/images/dashbord_logout.png" alt="Logout">
                                <span>Logout</span>
                            </a>
                        </nav>
                    </aside>

                    <!-- Dashboard Main Content -->
                    <main class="dashboard-main">
                        <button class="dashboard-sidebar-toggle"><i class="fa-solid fa-bars"></i> Menu</button>
                        <div class="orders-header dashboard-content-header">
                            <a href="orders.html" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to Orders</a>
                            <h1 class="orders-title">ORDER #LP-2026-9824</h1>
                            <p class="orders-subtitle">Placed on June 15, 2026</p>
                        </div>
                        
                        <div class="order-details-wrapper">
                            <!-- Progress Tracker -->
                            <div class="order-progress-card">
                                <div class="progress-track">
                                    <div class="progress-step active">
                                        <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                                        <div class="step-label">Order Placed</div>
                                        <div class="step-date">Jun 15</div>
                                    </div>
                                    <div class="progress-step active">
                                        <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                                        <div class="step-label">Processing</div>
                                        <div class="step-date">Jun 16</div>
                                    </div>
                                    <div class="progress-step active">
                                        <div class="step-icon"><i class="fa-solid fa-truck"></i></div>
                                        <div class="step-label">Shipped</div>
                                        <div class="step-date">Jun 17</div>
                                    </div>
                                    <div class="progress-step">
                                        <div class="step-icon"><i class="fa-solid fa-box-open"></i></div>
                                        <div class="step-label">Delivered</div>
                                        <div class="step-date">Est. Jun 20</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Layout Grid for Details & Summary -->
                            <div class="order-details-grid">
                                <!-- Left Column: Items & Address -->
                                <div class="order-details-main">
                                    <div class="details-card">
                                        <h3 class="details-card-title">Items in your order</h3>
                                        <div class="order-items-list">
                                            <div class="order-item-detailed">
                                                <img src="assets/images/products/best_seller_1.png" alt="Noir Emir">
                                                <div class="item-info">
                                                    <h4>Noir Emir</h4>
                                                    <p>100ml Eau De Parfum</p>
                                                    <p>Qty: 1</p>
                                                </div>
                                                <div class="item-price">₹3,299.00</div>
                                            </div>
                                            <div class="order-item-detailed">
                                                <img src="assets/images/products/best_seller_2.png" alt="Rosea">
                                                <div class="item-info">
                                                    <h4>Rosea</h4>
                                                    <p>100ml Eau De Parfum</p>
                                                    <p>Qty: 1</p>
                                                </div>
                                                <div class="item-price">₹3,299.00</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="details-card address-card-split">
                                        <div class="address-col">
                                            <h3 class="details-card-title">Shipping Address</h3>
                                            <div class="address-display">
                                                <p class="address-name">Bilal Khilji</p>
                                                <p>A-152, Bhagat Singh Colony</p>
                                                <p>Bhiwadi, Rajasthan 301019</p>
                                                <p>India</p>
                                                <p>Phone: +91 98765 43210</p>
                                            </div>
                                        </div>
                                        <div class="address-col">
                                            <h3 class="details-card-title">Billing Address</h3>
                                            <div class="address-display">
                                                <p class="address-name">Bilal Khilji</p>
                                                <p>A-152, Bhagat Singh Colony</p>
                                                <p>Bhiwadi, Rajasthan 301019</p>
                                                <p>India</p>
                                                <p>Phone: +91 98765 43210</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Summary -->
                                <div class="order-details-sidebar">
                                    <div class="details-card summary-card">
                                        <h3 class="details-card-title">Order Summary</h3>
                                        <div class="summary-row">
                                            <span>Subtotal (2 items)</span>
                                            <span>₹6,598.00</span>
                                        </div>
                                        <div class="summary-row">
                                            <span>Shipping</span>
                                            <span>Free</span>
                                        </div>
                                        <div class="summary-row">
                                            <span>Tax</span>
                                            <span>Inclusive</span>
                                        </div>
                                        <div class="summary-divider"></div>
                                        <div class="summary-row total-row">
                                            <span>Total</span>
                                            <span>₹6,598.00</span>
                                        </div>
                                        <div class="summary-actions">
                                            <button class="lp-btn lp-btn-solid w-100 mb-2" onclick="window.location.href='invoice.html'">Download Invoice</button>
                                            <button class="lp-btn lp-btn-outline w-100">Buy Again</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </main>
                </div>
            </div>
        </section>
        
    </div>


@endsection