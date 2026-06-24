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

            <form class="login-form" id="register-form">
                <!-- Step 1: Enter Mobile Number -->
                <div id="step-mobile" class="form-step">
                    <div class="form-group mb-3">
                        <label class="visually-hidden" for="mobile">Mobile Number</label>
                        <input type="tel" id="mobile" class="form-control" placeholder="Enter Mobile Number" required
                            pattern="[0-9]{10}">
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
                        <input type="text" id="otp" class="form-control" placeholder="Enter OTP" required maxlength="6">
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
                    <h4 style="font-family: 'Cinzel', serif; color: #1F5552; margin-bottom: 20px;">Verification Successful
                    </h4>
                    <p style="font-family: 'Outfit', sans-serif; font-size: 14px; color: #444; margin-bottom: 30px;">How
                        would you like to proceed?</p>

                    <button type="button" id="btn-choice-guest" class="login-submit-btn w-100 mb-3" style="margin: 0;">Guest
                        Login</button>
                    <button type="button" id="btn-choice-register" class="login-submit-btn w-100"
                        style="margin: 0; background-color: transparent; color: #1F5552; border: 1px solid #1F5552;">Register</button>
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
                        <input type="password" id="password" class="form-control" placeholder="Enter Password" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="visually-hidden" for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" class="form-control"
                            placeholder="Confirm Password">
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
                Already have an account? <a href="{{ route('user.login') }}">Login</a>
            </p>
        </div>
    </section>

    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]').content;

        function showStep(id) {
            document.querySelectorAll('.form-step').forEach(el => {
                el.style.display = 'none';
            });

            document.getElementById(id).style.display = 'block';
        }

        // Send OTP
        document.getElementById('btn-send-otp').addEventListener('click', () => {

            fetch("{{ url('/user/send-otp') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    mobile: document.getElementById('mobile').value
                })
            })
                .then(response => response.json())
                .then(data => {

                    if (data.status) {

                        Swal.fire({
                            icon: 'success',
                            title: 'OTP Sent',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        showStep('step-otp');

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                            confirmButtonColor: '#1F5552'
                        });

                    }

                })
                .catch(() => {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonColor: '#1F5552'
                    });

                });

        });


        // Verify OTP
        document.getElementById('btn-verify-otp').addEventListener('click', () => {

            fetch("{{ url('/user/verify-otp') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    otp: document.getElementById('otp').value
                })
            })
                .then(response => response.json())
                .then(data => {

                    if (data.status) {

                        Swal.fire({
                            icon: 'success',
                            title: 'OTP Verified',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        showStep('step-choice');

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid OTP',
                            text: data.message,
                            confirmButtonColor: '#1F5552'
                        });

                    }

                })
                .catch(() => {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonColor: '#1F5552'
                    });

                });

        });


        // Guest Login
        document.getElementById('btn-choice-guest').addEventListener('click', () => {

            fetch("{{ url('/user/guest-login') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf
                }
            })
                .then(response => response.json())
                .then(data => {

                    if (data.status) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Welcome',
                            text: 'Logging you in...',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {

                            window.location.href = data.redirect;

                        });

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                            confirmButtonColor: '#1F5552'
                        });

                    }

                });

        });


        // Register Choice
        document.getElementById('btn-choice-register').addEventListener('click', () => {

            showStep('step-details');

        });


        // Register Submit
        document.getElementById('register-form').addEventListener('submit', function (e) {

            e.preventDefault();

            fetch("{{ url('/user/register') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    name: document.getElementById('fullname').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    password_confirmation: document.getElementById('password_confirmation').value
                })
            })
                .then(response => response.json())
                .then(data => {

                    if (data.status) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {

                            window.location.href = data.redirect;

                        });

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                            confirmButtonColor: '#1F5552'
                        });

                    }

                })
                .catch(() => {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonColor: '#1F5552'
                    });

                });

        });


        // Resend OTP
        document.getElementById('btn-resend-otp').addEventListener('click', function (e) {

            e.preventDefault();

            document.getElementById('btn-send-otp').click();

        });

    </script>

@endsection