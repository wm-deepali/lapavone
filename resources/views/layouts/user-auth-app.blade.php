<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | La Pavone</title>
    <meta name="description" content="Sign in to your La Pavone account.">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts: Cinzel for Luxury Headings & Outfit for UI -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
     <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .google-login-btn {
            border: 1px solid rgba(35, 75, 70, 0.18);
            border-radius: 50px;
            background: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            font-size: 14px;
            color: #1F5552;
            padding: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            outline: none;
        }
        .google-login-btn:hover {
            background-color: rgba(35, 75, 70, 0.04);
            border-color: rgba(35, 75, 70, 0.4);
            transform: translateY(-1px);
        }
        .google-login-btn img {
            width: 18px;
            height: 18px;
            margin-right: 12px;
        }
    </style>
</head>

<body>
    <div class="la-pavone-wrapper login-page-wrapper">
        <!-- 1. STATIC NAVBAR -->
        <nav class="lp-navbar" style="position: relative; z-index: 10; background: #fff;">
            <div class="lp-container lp-nav-content">
                <div class="nav-brand">
                    <a href="index.html"><img src="{{ asset('assets/images/logo.png')}}" alt="La Pavone"></a>
                </div>

                <ul class="nav-links">
                    <li class="nav-item" id="nav-shop-all">
                        <a href="shopall.html">Shop All</a>
                        <!-- Mega Menu -->
                        <div class="mega-menu" id="mega-menu">
                            <div class="mega-menu-inner">
                                <ul class="mega-menu-list left-list">
                                    <li><a href="shopall.html?filter=men">Men</a></li>
                                    <li><a href="shopall.html?filter=women">Women</a></li>
                                    <li><a href="shopall.html?filter=unisex">Unisex</a></li>
                                </ul>
                                <div class="mega-menu-divider"></div>
                                <ul class="mega-menu-list right-list">
                                    <li><a href="shopall.html">Fragrance Family</a></li>
                                    <li><a href="shopall.html?filter=everyday">Everyday</a></li>
                                    <li><a href="shopall.html?filter=oud">Oud</a></li>
                                    <li><a href="shopall.html?filter=amber">Amber</a></li>
                                    <li><a href="shopall.html?filter=signature">Signature</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"><a href="shopall.html">New</a></li>
                    <li class="nav-item"><a href="about.html">About La Pavone</a></li>
                </ul>

                <div class="nav-icons">
                                        <button aria-label="Search">
                        <img src="{{ asset('assets/images/menu_search.png')}}" alt="Search">
                    </button>
                    <a href="wishlist.html" aria-label="Wishlist">
                        <img src="{{ asset('assets/images/menu_wishlist.png')}}" alt="Wishlist">
                    </a>
                    <a href="login.html" aria-label="Account">
                        <img src="{{ asset('assets/images/menu_user.png')}}" alt="Account">
                    </a>
                    <a href="cart.html" aria-label="Cart">
                        <img src="{{ asset('assets/images/menu_cart.png')}}" alt="Cart">
                    </a>
                    <button class="mobile-nav-toggle" aria-label="Toggle Menu">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>


        @yield('content')


        <!-- 9. FOOTER -->
    <!-- Simplified Custom Login Footer -->
        <footer class="login-simple-footer">
            <div class="lp-container">
                <div class="footer-links-row">
                    <span class="footer-copyright">&copy;2026, La Pavone</span>
                    <div class="footer-nav">
                            <a href="#" class="footer-link">Privacy Policy</a>
                            <a href="terms-conditions.html" class="footer-link">Terms & Conditions</a>
                            <a href="faq.html" class="footer-link">FAQs</a>
                            <a href="blog.html" class="footer-link">Blogs</a>
                            <a href="#" class="footer-link">Shipping & Refund Policy</a>
                            <a href="contact.html" class="footer-link">Contact Us</a>
                        </div>
                </div>
                <div class="footer-address">
                    Infinite Horizon<br>
                    A-162, Bhagat Singh Colony<br>
                    Bhiwadi, Rajasthan
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Step-by-Step Login JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stepMobile = document.getElementById('step-mobile');
            const stepOtp = document.getElementById('step-otp');

            const mobileInput = document.getElementById('mobile');
            const otpInput = document.getElementById('otp');

            const btnSendOtp = document.getElementById('btn-send-otp');
            const btnVerifyOtp = document.getElementById('btn-verify-otp');
            const btnResendOtp = document.getElementById('btn-resend-otp');
            const btnBack = document.getElementById('btn-back');

            const mobileError = document.getElementById('mobile-error');
            const otpError = document.getElementById('otp-error');
            
            const googleBtn = document.querySelector('.google-login-btn');

            // Send OTP Action
            btnSendOtp.addEventListener('click', () => {
                const mobileValue = mobileInput.value.trim();
                const mobileRegex = /^[0-9]{10}$/; // Basic 10-digit check

                if (mobileRegex.test(mobileValue)) {
                    mobileError.style.display = 'none';
                    mobileInput.classList.remove('is-invalid');
                    
                    // Proceed to OTP step
                    stepMobile.style.display = 'none';
                    stepOtp.style.display = 'block';
                    
                    console.log('Mock OTP sent. Code: 1234');
                } else {
                    mobileError.style.display = 'block';
                    mobileInput.classList.add('is-invalid');
                }
            });

            // Verify OTP Action
            btnVerifyOtp.addEventListener('click', () => {
                const otpValue = otpInput.value.trim();

                // Mock verification: accept '1234'
                if (otpValue === '1234') {
                    otpError.style.display = 'none';
                    otpInput.classList.remove('is-invalid');

                    // Success - Redirect to Profile page
                    window.location.href = 'profile.html';
                } else {
                    otpError.style.display = 'block';
                    otpInput.classList.add('is-invalid');
                }
            });

            // Back Action
            btnBack.addEventListener('click', (e) => {
                e.preventDefault();
                stepOtp.style.display = 'none';
                stepMobile.style.display = 'block';
                otpInput.value = '';
                otpError.style.display = 'none';
                otpInput.classList.remove('is-invalid');
            });

            // Resend OTP Action
            btnResendOtp.addEventListener('click', (e) => {
                e.preventDefault();
                otpInput.value = '';
                otpError.style.display = 'none';
                otpInput.classList.remove('is-invalid');
                alert('A new OTP has been sent to your mobile number. (Use "1234" to verify)');
            });

            // Google Login Button Mock Action
            if (googleBtn) {
                googleBtn.addEventListener('click', () => {
                    // Redirect to Profile on Google sign-in
                    window.location.href = 'profile.html';
                });
            }

            // Support Enter key triggers
            mobileInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    btnSendOtp.click();
                }
            });

            otpInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    btnVerifyOtp.click();
                }
            });
        });
    </script>
</body>

</html>
