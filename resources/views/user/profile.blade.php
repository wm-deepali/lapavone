@extends('layouts.app')
@section('content')

    <div class="dashboard-page-wrapper">

     <!-- DASHBOARD SECTION -->
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
                            <a href="addresses.html" class="dashboard-nav-item">
                                <img src="assets/images/dashbord_location.png" alt="Addresses">
                                <span>Addresses</span>
                            </a>
                            <a href="profile.html" class="dashboard-nav-item active">
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
                            <h1 class="orders-title">MY PROFILE</h1>
                            <p class="orders-subtitle">Manage your personal information and security</p>
                        </div>
                        
                        <div class="profile-details-wrapper">
                            <div class="profile-card">
                                <h3 class="profile-card-title">Personal Information</h3>
                                <form class="profile-form">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" value="Bilal" class="lp-input" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" value="Khilji" class="lp-input" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" value="bilal.khilji@example.com" class="lp-input" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="tel" value="+91 98765 43210" class="lp-input" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="text" value="15 June 1995" class="lp-input" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input type="text" value="Male" class="lp-input" readonly>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="button" class="lp-btn lp-btn-solid">Edit Details</button>
                                    </div>
                                </form>
                            </div>

                            <div class="profile-card">
                                <h3 class="profile-card-title">Default Shipping Address</h3>
                                <div class="address-display">
                                    <p class="address-name">Bilal Khilji</p>
                                    <p class="address-line">A-152, Bhagat Singh Colony</p>
                                    <p class="address-line">Bhiwadi, Rajasthan 301019</p>
                                    <p class="address-line">India</p>
                                    <p class="address-phone">T: +91 98765 43210</p>
                                </div>
                                <div class="form-actions mt-3">
                                    <button type="button" class="lp-btn lp-btn-outline">Manage Addresses</button>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </section>
        
    </div>


@endsection