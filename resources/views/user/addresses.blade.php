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
                            <a href="orders.html" class="dashboard-nav-item">
                                <img src="assets/images/dashbord_oder.png" alt="Orders">
                                <span>Orders</span>
                            </a>
                            <a href="wishlist.html" class="dashboard-nav-item">
                                <img src="assets/images/dashbord_wishlist.png" alt="Wishlist">
                                <span>Wishlist</span>
                            </a>
                            <a href="addresses.html" class="dashboard-nav-item active">
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
                            <h1 class="orders-title">MY ADDRESSES</h1>
                            <p class="orders-subtitle">Manage your shipping and billing addresses</p>
                        </div>
                        
                        <div class="addresses-grid">
                            <!-- Add New Address Card -->
                            <div class="address-card address-card-add-new">
                                <i class="fa-solid fa-plus add-new-icon"></i>
                                <span class="add-new-text">Add New Address</span>
                            </div>

                            <!-- Address 1 (Default) -->
                            <div class="address-card">
                                <div class="address-card-badge">Default Shipping</div>
                                <div class="address-header">
                                    <h3 class="address-name-display">Bilal Khilji</h3>
                                </div>
                                <div class="address-body">
                                    <p>A-152, Bhagat Singh Colony</p>
                                    <p>Near Central Park</p>
                                    <p>Bhiwadi, Rajasthan 301019</p>
                                    <p>India</p>
                                    <p style="margin-top: 10px;">Phone: +91 98765 43210</p>
                                </div>
                                <div class="address-footer">
                                    <button class="btn-address-action">Edit</button>
                                    <button class="btn-address-action btn-address-delete">Delete</button>
                                </div>
                            </div>

                            <!-- Address 2 -->
                            <div class="address-card">
                                <div class="address-header">
                                    <h3 class="address-name-display">Bilal Khilji (Office)</h3>
                                </div>
                                <div class="address-body">
                                    <p>Tech Park Tower B, 4th Floor</p>
                                    <p>Sector 45</p>
                                    <p>Gurugram, Haryana 122003</p>
                                    <p>India</p>
                                    <p style="margin-top: 10px;">Phone: +91 99887 76655</p>
                                </div>
                                <div class="address-footer">
                                    <button class="btn-address-action">Edit</button>
                                    <button class="btn-address-action">Set as Default</button>
                                    <button class="btn-address-action btn-address-delete">Delete</button>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </section>
    </div>


@endsection