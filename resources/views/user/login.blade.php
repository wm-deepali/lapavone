@extends('layouts.user-auth-app')
@section('content')

     <section class="login-fullscreen-section">
            <div class="login-card">
                <h1 class="login-title">LOGIN</h1>
                
                <div class="login-decorative-divider">
                    <img src="{{ asset('assets/images/login_card_innericon.png')}}" alt="La Pavone Emblem" class="login-decorative-icon" onerror="this.style.display='none'">
                </div>

                <form class="login-form" id="login-form" action="profile.html">
                    <!-- Step 1: Enter Mobile Number -->
                    <div id="step-mobile" class="form-step">
                        <div class="form-group mb-3">
                            <label class="visually-hidden" for="mobile">Mobile Number</label>
                            <input type="tel" id="mobile" class="form-control" placeholder="Enter Mobile Number" required pattern="[0-9]{10}">
                            <div class="invalid-feedback text-start" id="mobile-error" style="display: none; color: #dc3545; font-size: 13px; margin-top: 5px; font-family: 'Outfit', sans-serif;">Please enter a valid 10-digit mobile number.</div>
                        </div>
                        <button type="button" id="btn-send-otp" class="login-submit-btn w-100 m-0">Send OTP</button>

                        <!-- OR Divider -->
                        <div class="d-flex align-items-center my-3 text-muted" style="font-family: 'Outfit', sans-serif; font-size: 12px; letter-spacing: 0.5px;">
                            <hr style="flex-grow: 1; border-color: rgba(35, 75, 70, 0.15); margin: 0 10px;">
                            <span>OR</span>
                            <hr style="flex-grow: 1; border-color: rgba(35, 75, 70, 0.15); margin: 0 10px;">
                        </div>

                        <!-- Google Sign-In -->
                        <button type="button" class="google-login-btn w-100 d-flex align-items-center justify-content-center">
                            <img src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" alt="Google Logo">
                            Login with Google
                        </button>
                    </div>

                    <!-- Step 2: Enter OTP -->
                    <div id="step-otp" class="form-step" style="display: none;">
                        <div class="form-group mb-3">
                            <label class="visually-hidden" for="otp">Enter OTP</label>
                            <input type="text" id="otp" class="form-control" placeholder="Enter OTP" required maxlength="6">
                            <div class="invalid-feedback text-start" id="otp-error" style="display: none; color: #dc3545; font-size: 13px; margin-top: 5px; font-family: 'Outfit', sans-serif;">Invalid OTP. Please enter '1234' to verify.</div>
                        </div>
                        <button type="button" id="btn-verify-otp" class="login-submit-btn w-100 m-0">Verify & Login</button>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="#" id="btn-back" style="font-family: 'Outfit', sans-serif; font-size: 12px; color: #666; text-decoration: underline;"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
                            <a href="#" id="btn-resend-otp" style="font-family: 'Outfit', sans-serif; font-size: 12px; color: #1F5552; text-decoration: underline;">Resend OTP</a>
                        </div>
                    </div>
                </form>

                <p class="login-register-link mt-2">
                    Don't have an account? <a href="register.html">Register</a>
                </p>
            </div>
        </section>
@endsection