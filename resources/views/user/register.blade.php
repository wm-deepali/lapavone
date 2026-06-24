@extends('layouts.user-auth-app')
@section('content')

    <!-- Main Register Section with Background Image -->
        <section class="login-fullscreen-section">
            <div class="login-card">
                <h1 class="login-title">REGISTER</h1>

                <div class="login-decorative-divider">
                    <img src="{{ asset('assets/images/login_card_innericon.png')}}" alt="La Pavone Emblem"
                        class="login-decorative-icon" onerror="this.style.display='none'">
                </div>

                <form class="login-form" id="register-form" action="profile.html">
                    <!-- Step 1: Enter Mobile Number -->
                    <div id="step-mobile" class="form-step">
                        <div class="form-group mb-3">
                            <label class="visually-hidden" for="mobile">Mobile Number</label>
                            <input type="tel" id="mobile" class="form-control" placeholder="Enter Mobile Number"
                                required pattern="[0-9]{10}">
                            <div class="invalid-feedback text-start" id="mobile-error"
                                style="display: none; color: #dc3545; font-size: 13px; margin-top: 5px; font-family: 'Outfit', sans-serif;">
                                Please enter a valid 10-digit mobile number.</div>
                        </div>
                        <button type="button" id="btn-send-otp" class="login-submit-btn w-100 m-0">Send OTP</button>
                    </div>

                    <!-- Step 2: Enter OTP -->
                    <div id="step-otp" class="form-step" style="display: none;">
                        <div class="form-group mb-3">
                            <label class="visually-hidden" for="otp">Enter OTP</label>
                            <input type="text" id="otp" class="form-control" placeholder="Enter OTP" required
                                maxlength="6">
                            <div class="invalid-feedback text-start" id="otp-error"
                                style="display: none; color: #dc3545; font-size: 13px; margin-top: 5px; font-family: 'Outfit', sans-serif;">
                                Invalid OTP. Please enter '1234' to verify.</div>
                        </div>
                        <button type="button" id="btn-verify-otp" class="login-submit-btn w-100 m-0">Verify OTP</button>
                        <div class="text-end mt-2">
                            <a href="#" id="btn-resend-otp"
                                style="font-family: 'Outfit', sans-serif; font-size: 12px; color: #1F5552; text-decoration: underline;">Resend
                                OTP</a>
                        </div>
                    </div>

                    <!-- Step 2.5: Choose Registration or Guest -->
                    <div id="step-choice" class="form-step" style="display: none; text-align: center;">
                        <h4 style="font-family: 'Cinzel', serif; color: #1F5552; margin-bottom: 20px;">Verification Successful</h4>
                        <p style="font-family: 'Outfit', sans-serif; font-size: 14px; color: #444; margin-bottom: 30px;">How would you like to proceed?</p>
                        
                        <button type="button" id="btn-choice-guest" class="login-submit-btn w-100 mb-3" style="margin: 0;">Guest Login</button>
                        <button type="button" id="btn-choice-register" class="login-submit-btn w-100" style="margin: 0; background-color: transparent; color: #1F5552; border: 1px solid #1F5552;">Register</button>
                    </div>

                    <!-- Step 3: Registration Profile Details -->
                    <div id="step-details" class="form-step" style="display: none;">
                        <div class="form-group mb-3">
                            <label class="visually-hidden" for="fullname">Full Name</label>
                            <input type="text" id="fullname" class="form-control" placeholder="Full Name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="visually-hidden" for="email">Email Id</label>
                            <input type="email" id="email" class="form-control" placeholder="Email Id" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="visually-hidden" for="password">Enter Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Enter Password"
                                required>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-4 mb-3 login-options">
                            <div class="form-check m-0 p-0">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <button type="submit" class="login-submit-btn m-0" style="width: 70%;">Register</button>
                        </div>
                    </div>
                </form>

                <p class="login-register-link mt-2">
                    Already have an account? <a href="login.html">Login</a>
                </p>
            </div>
        </section>

@endsection