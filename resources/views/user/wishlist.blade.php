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
                            <a href="orders.html" class="dashboard-nav-item">
                                <img src="assets/images/dashbord_oder.png" alt="Orders">
                                <span>Orders</span>
                            </a>
                            <a href="wishlist.html" class="dashboard-nav-item active">
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
                            <h1 class="orders-title">MY WISHLIST</h1>
                            <p class="orders-subtitle">Items you've saved for later</p>
                        </div>

                        <div class="wishlist-grid">
                            <!-- Product 1 -->
                            <div class="product-card is-visible">
                                <div class="product-image-wrap">
                                    <img src="assets/images/products/best_seller_1.png" alt="Reign"
                                        class="product-image-primary" loading="lazy">
                                    <button class="wishlist-remove-btn" aria-label="Remove from Wishlist"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </div>
                                <div class="product-info">
                                    <div class="product-details">
                                        <div class="product-name">Reign</div>
                                        <div class="product-price-card">₹3999</div>
                                    </div>
                                    <div class="product-actions">
                                        <button class="lp-btn lp-btn-solid add-to-cart-btn"
                                            style="padding: 10px 16px; font-size: 14px; width: 100%;">Add to Cart</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Product 2 -->
                            <div class="product-card is-visible">
                                <div class="product-image-wrap">
                                    <img src="assets/images/products/best_seller_2.png" alt="Rosea"
                                        class="product-image-primary" loading="lazy">
                                    <button class="wishlist-remove-btn" aria-label="Remove from Wishlist"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </div>
                                <div class="product-info">
                                    <div class="product-details">
                                        <div class="product-name">Rosea</div>
                                        <div class="product-price-card">₹3999</div>
                                    </div>
                                    <div class="product-actions">
                                        <button class="lp-btn lp-btn-solid add-to-cart-btn"
                                            style="padding: 10px 16px; font-size: 14px; width: 100%;">Add to Cart</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Product 3 -->
                            <div class="product-card is-visible">
                                <div class="product-image-wrap">
                                    <img src="assets/images/products/best_seller_3.png" alt="Emeraude"
                                        class="product-image-primary" loading="lazy">
                                    <button class="wishlist-remove-btn" aria-label="Remove from Wishlist"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </div>
                                <div class="product-info">
                                    <div class="product-details">
                                        <div class="product-name">Emeraude</div>
                                        <div class="product-price-card">₹3999</div>
                                    </div>
                                    <div class="product-actions">
                                        <button class="lp-btn lp-btn-solid add-to-cart-btn"
                                            style="padding: 10px 16px; font-size: 14px; width: 100%;">Add to Cart</button>
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