@extends('layouts.app')
@section('content')

    <div class="orders-page-wrapper">

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
                            <h1 class="orders-title">MY ORDERS</h1>
                            <p class="orders-subtitle">View and track your luxury purchases</p>
                        </div>

                        <div class="orders-list">
                            <!-- Order Card 1 -->
                            <div class="order-card">
                                <div class="order-card-header">
                                    <div class="order-info-group">
                                        <span class="order-label">Order Number</span>
                                        <span class="order-value">#LP-2026-9824</span>
                                    </div>
                                    <div class="order-info-group">
                                        <span class="order-label">Date Placed</span>
                                        <span class="order-value">June 15, 2026</span>
                                    </div>
                                    <div class="order-info-group">
                                        <span class="order-label">Total Amount</span>
                                        <span class="order-value">₹6,598.00</span>
                                    </div>
                                    <div class="order-status-group">
                                        <span class="status-badge status-delivered">Delivered</span>
                                    </div>
                                </div>
                                <div class="order-card-body">
                                    <div class="order-items">
                                        <div class="order-item">
                                            <img src="assets/images/products/best_seller_1.png" alt="Noir Emir"
                                                class="order-item-img">
                                            <div class="order-item-details">
                                                <h3 class="order-item-title">Noir Emir</h3>
                                                <p class="order-item-meta">100ml | Qty: 1</p>
                                                <p class="order-item-price">₹3,299.00</p>
                                            </div>
                                        </div>
                                        <div class="order-item">
                                            <img src="assets/images/products/best_seller_2.png" alt="Rosea"
                                                class="order-item-img">
                                            <div class="order-item-details">
                                                <h3 class="order-item-title">Rosea</h3>
                                                <p class="order-item-meta">100ml | Qty: 1</p>
                                                <p class="order-item-price">₹3,299.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-actions">
                                        <button class="btn-order-action btn-outline"
                                            onclick="window.location.href='invoice.html'">View Invoice</button>
                                        <button class="btn-order-action btn-solid">Buy Again</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Card 2 -->
                            <div class="order-card">
                                <div class="order-card-header">
                                    <div class="order-info-group">
                                        <span class="order-label">Order Number</span>
                                        <span class="order-value">#LP-2026-8711</span>
                                    </div>
                                    <div class="order-info-group">
                                        <span class="order-label">Date Placed</span>
                                        <span class="order-value">May 28, 2026</span>
                                    </div>
                                    <div class="order-info-group">
                                        <span class="order-label">Total Amount</span>
                                        <span class="order-value">₹3,999.00</span>
                                    </div>
                                    <div class="order-status-group">
                                        <span class="status-badge status-shipped">Shipped</span>
                                    </div>
                                </div>
                                <div class="order-card-body">
                                    <div class="order-items">
                                        <div class="order-item">
                                            <img src="assets/images/products/best_seller_3.png" alt="Emeraude"
                                                class="order-item-img">
                                            <div class="order-item-details">
                                                <h3 class="order-item-title">Emeraude</h3>
                                                <p class="order-item-meta">100ml | Qty: 1</p>
                                                <p class="order-item-price">₹3,999.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-actions">
                                        <button class="btn-order-action btn-outline">Track Order</button>
                                        <button class="btn-order-action btn-solid"
                                            onclick="window.location.href='order-details.html'">View Details</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Card 3 -->
                            <div class="order-card">
                                <div class="order-card-header">
                                    <div class="order-info-group">
                                        <span class="order-label">Order Number</span>
                                        <span class="order-value">#LP-2026-6542</span>
                                    </div>
                                    <div class="order-info-group">
                                        <span class="order-label">Date Placed</span>
                                        <span class="order-value">April 10, 2026</span>
                                    </div>
                                    <div class="order-info-group">
                                        <span class="order-label">Total Amount</span>
                                        <span class="order-value">₹7,998.00</span>
                                    </div>
                                    <div class="order-status-group">
                                        <span class="status-badge status-delivered">Delivered</span>
                                    </div>
                                </div>
                                <div class="order-card-body">
                                    <div class="order-items">
                                        <div class="order-item">
                                            <img src="assets/images/products/best_seller_1.png" alt="Reign"
                                                class="order-item-img">
                                            <div class="order-item-details">
                                                <h3 class="order-item-title">Reign</h3>
                                                <p class="order-item-meta">100ml | Qty: 1</p>
                                                <p class="order-item-price">₹3,999.00</p>
                                            </div>
                                        </div>
                                        <div class="order-item">
                                            <img src="assets/images/products/best_seller_3.png" alt="Emeraude"
                                                class="order-item-img">
                                            <div class="order-item-details">
                                                <h3 class="order-item-title">Emeraude</h3>
                                                <p class="order-item-meta">100ml | Qty: 1</p>
                                                <p class="order-item-price">₹3,999.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-actions">
                                        <button class="btn-order-action btn-outline"
                                            onclick="window.location.href='invoice.html'">View Invoice</button>
                                        <button class="btn-order-action btn-solid">Buy Again</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Card 4 -->
                            <div class="order-card">
                                <div class="order-card-header">
                                    <div class="order-info-group">
                                        <span class="order-label">Order Number</span>
                                        <span class="order-value">#LP-2026-3321</span>
                                    </div>
                                    <div class="order-info-group">
                                        <span class="order-label">Date Placed</span>
                                        <span class="order-value">March 02, 2026</span>
                                    </div>
                                    <div class="order-info-group">
                                        <span class="order-label">Total Amount</span>
                                        <span class="order-value">₹3,299.00</span>
                                    </div>
                                    <div class="order-status-group">
                                        <span class="status-badge"
                                            style="background-color: #E3F2FD; color: #1565C0;">Processing</span>
                                    </div>
                                </div>
                                <div class="order-card-body">
                                    <div class="order-items">
                                        <div class="order-item">
                                            <img src="assets/images/products/best_seller_2.png" alt="Rosea"
                                                class="order-item-img">
                                            <div class="order-item-details">
                                                <h3 class="order-item-title">Rosea</h3>
                                                <p class="order-item-meta">100ml | Qty: 1</p>
                                                <p class="order-item-price">₹3,299.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-actions">
                                        <button class="btn-order-action btn-outline">Track Order</button>
                                        <button class="btn-order-action btn-solid"
                                            onclick="window.location.href='order-details.html'">View Details</button>
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