@extends('layouts.app')
@section('content')


    <main class="contact-page-content">
        <!-- 1. Hero Section -->
        <section class="contact-hero-split">
            <div class="contact-hero-left">
                <img src="{{ asset('assets/images/contact_hero.png') }}" alt="Contact Hero">
            </div>
            <div class="contact-hero-right">
                <div class="contact-hero-content">
                    <h1 class="hero-right-title">GET IN TOUCH WITH US</h1>
                    <p class="hero-right-text">Whether you're looking for your next signature scent,<br>have a
                        question about an order, or simply want to know more<br>about our fragrances, we're here to
                        help.</p>
                </div>
            </div>
        </section>

        <!-- 2. Text Section -->
        <section class="contact-text-section">
            <div class="lp-container">
                <h1 class="contact-title">BECAUSE GOOD CONVERSATIONS DESERVE<br>THE SAME ATTENTION AS GOOD
                    FRAGRANCES.</h1>
                <p class="contact-subtitle">For product recommendations, order support, collaborations, or general
                    enquiries,<br>reach out to us and our team will get back to you as soon as possible.</p>
            </div>
        </section>

        <!-- 3. Form Section -->
        <section class="contact-form-section">
            <div class="contact-form-container">
                <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                    @csrf

                    @if(session('success'))
                        <div class="alert alert-success mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}"
                            placeholder="Enter your name">

                        @error('first_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}"
                            placeholder="Enter your surname">

                        @error('last_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>
                            Phone Number
                            <span class="optional">(Optional)</span>
                        </label>

                        <div class="phone-input-group">
                            <select class="form-control country-select" name="country_code">
                                <option value="+91" selected>IN (+91)</option>
                                <option value="+1">US (+1)</option>
                                <option value="+44">UK (+44)</option>
                                <option value="+61">AU (+61)</option>
                                <option value="+971">UAE (+971)</option>
                            </select>

                            <input type="tel" name="mobile" class="form-control phone-input" value="{{ old('mobile') }}"
                                placeholder="9876543210">
                        </div>

                        @error('mobile')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>

                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Enter your email">

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Message</label>

                        <textarea name="message" rows="4" class="form-control"
                            placeholder="Write your message">{{ old('message') }}</textarea>

                        @error('message')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                        </div>

                        @error('g-recaptcha-response')
                            <small class="text-danger d-block mt-2">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">
                        Submit
                    </button>
                </form>
            </div>
        </section>

        <!-- 4. Customer Service Section -->
        <section class="contact-service-section">
            <div class="lp-container">
                <h2 class="service-title">CUSTOMER SERVICE</h2>
                <p class="service-time">Monday to Friday, 10am - 5pm EST</p>
                <a href="mailto:info@lapavone.com" class="service-link">Email Us</a>


            </div>
        </section>
    </main>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection