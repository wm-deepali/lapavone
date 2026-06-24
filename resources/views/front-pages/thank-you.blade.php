@extends('layouts.user-auth-app')
@section('content')

 <!-- Main Thank You Section with Background Image -->
        <section class="thankyou-fullscreen-section">
            <div class="thankyou-card">
                <i class="fa-regular fa-circle-check thankyou-icon"></i>
                <h1 class="thankyou-title">THANK YOU!</h1>

                <p class="thankyou-subtitle">
                    Your order has been placed successfully. <br>
                    Your order number is <span class="thankyou-order-number">#LP-908234</span>.<br>
                    We will send you an email confirmation with your tracking details shortly.
                </p>

                <a href="shopall.html" class="thankyou-action-btn">Continue Shopping</a>
            </div>
        </section>
        
@endsection