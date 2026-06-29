@extends('layouts.app')
@section('content')


    <!-- 2. ABOUT HERO SECTION -->
        <section class="about-hero-section">
            <div class="about-hero-wrapper">
                <video class="about-hero-bg" autoplay loop muted playsinline>
    <source src="{{ asset('assets/images/about_banner.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
</video>
                <div class="about-hero-content">
                    <h1 class="about-hero-title">FOR THOSE WHO CHOOSE<br>WHAT FEELS RIGHT.</h1>
                </div>
            </div>
        </section>
        

        <!-- 3. QUESTION SECTION -->
        <section class="about-question-section">
            <h2 class="about-question-heading">IT STARTED WITH A SIMPLE QUESTION.</h2>




            <div class="about-3col-container">



                <div class="about-col about-col-dark about-col-left">

                    <div class="about-col-content">
                        <h3 class="about-col-title">WE NOTICED SOMETHING CHANGING.</h3>
                        <p class="about-col-text">People were becoming more thoughtful about what they brought into
                            their lives. Less about having more, and more about choosing better.</p>
                    </div>
                </div>
                <div class=" about-col-light">
                    <div class=" about-col-light_inner">
                        <h3 class="about-col-title dark-title">THAT'S THE IDEA BEHIND LA PAVONE.</h3>
                        <p class="about-col-text dark-text">The things we keep coming back to are rarely the loudest.
                            They're the ones that feel right, fit naturally into our lives, and stay with us over time.
                        </p>
                    </div>
                </div>
                <div class="about-col about-col-dark">
                    <h3 class="about-col-title">THAT'S WHAT WE BELIEVE.</h3>
                    <p class="about-col-text">Quality speaks for itself. The best things don't demand attention, they
                        earn a place in your everyday life.</p>
                </div>
            </div>
        </section>





        <!-- 4. FULL IMAGE SECTION -->
        <section class="about-full-img-section">
            <img src="{{ asset('assets/images/about_img2.png') }}" alt="La Pavone Archway" class="about-full-img">
        </section>

        <!-- 5. BOTTOM CARDS SECTION -->


      <section class="about-cards-section" id="horizontal-scroll-section">
            <div class="about-cards-sticky">
                <div class="about-cards-bg-wrapper">
                   <img src="{{ asset('assets/images/Testimonials 1.png') }}" alt="Background" class="about-cards-bg">
                </div>
                <div class="about-cards-container" id="horizontal-scroll-container">
                    <div class="about-card">
                        <div class="about-card-content">
                            <h3 class="about-card-title">SOMETHING CHANGING.</h3>
                            <p class="about-card-text">People were becoming more thoughtful about what they brought into
                                their
                                lives. Less about having more, and more about choosing better.</p>
                        </div>
                    </div>
                    <div class="about-card">
                        <div class="about-card-content">
                            <h3 class="about-card-title">THAT'S WHAT LED TO LA PAVONE.</h3>
                            <p class="about-card-text">We were inspired by the things people keep coming back to the ones
                                that
                                feel familiar, personal, and worth holding onto.</p>
                        </div>
                    </div>
                    <div class="about-card">
                        <div class="about-card-content">
                            <h3 class="about-card-title">THAT'S HOW...</h3>
                            <p class="about-card-text">Every fragrance is thoughtful, personal, and easy to wear. We
                                appreciate
                                quality and find...</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    

@endsection
