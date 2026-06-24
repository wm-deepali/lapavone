@extends('layouts.user-auth-app')
@section('content')

    <section class="login-fullscreen-section">
        <div class="login-card">
            <h1 class="login-title">LOGIN</h1>

            <div class="login-decorative-divider">
                <img src="{{ asset('assets/images/login_card_innericon.png')}}" alt="La Pavone Emblem"
                    class="login-decorative-icon" onerror="this.style.display='none'">
            </div>

            <form class="login-form" id="login-form">
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

                    <!-- OR Divider -->
                    <div class="d-flex align-items-center my-3 text-muted"
                        style="font-family: 'Outfit', sans-serif; font-size: 12px; letter-spacing: 0.5px;">
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
                        <div class="invalid-feedback text-start" id="otp-error"
                            style="display: none; color: #dc3545; font-size: 13px; margin-top: 5px; font-family: 'Outfit', sans-serif;">
                            Invalid OTP. Please enter valid Otp verify.</div>
                    </div>
                    <button type="button" id="btn-verify-otp" class="login-submit-btn w-100 m-0">Verify & Login</button>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="#" id="btn-back"
                            style="font-family: 'Outfit', sans-serif; font-size: 12px; color: #666; text-decoration: underline;"><i
                                class="fa-solid fa-arrow-left me-1"></i> Back</a>
                        <a href="#" id="btn-resend-otp"
                            style="font-family: 'Outfit', sans-serif; font-size: 12px; color: #1F5552; text-decoration: underline;">Resend
                            OTP</a>
                    </div>
                </div>
            </form>

            <p class="login-register-link mt-2">
                Don't have an account? <a href="{{ route('user.register') }}">Register</a>
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

            fetch("{{ url('/user/send-login-otp') }}", {
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

            fetch("{{ url('/user/verify-login-otp') }}", {
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
                            title: 'Login Successful',
                            text: 'Redirecting...',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {

                            window.location.href = data.redirect;

                        });

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


        // Resend OTP
        document.getElementById('btn-resend-otp').addEventListener('click', function (e) {

            e.preventDefault();

            fetch("{{ url('/user/send-login-otp') }}", {
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
                            title: 'OTP Resent',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
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


        // Back button
        document.getElementById('btn-back').addEventListener('click', function (e) {

            e.preventDefault();

            document.getElementById('otp').value = '';

            showStep('step-mobile');

        });

    </script>

@endsection