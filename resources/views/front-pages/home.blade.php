@extends('layouts.app')
@section('content')


    <!-- 2. HERO SECTION -->
    <section class="hero-section" id="hero">
        <img src="{{ $hero->background_image ? asset('storage/'.$hero->background_image) : 'assets/images/banners/banner_img.png' }}"
            alt="{{ $hero->heading_line1 }}" class="hero-bg" loading="eager">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-heading">
                {{ $hero->heading_line1 }}<br>{{ $hero->heading_line2 }}
            </h1>
            <div class="hero-buttons">
                <a href="{{ $hero->btn1_url }}" class="lp-btn">{{ $hero->btn1_label }}</a>
                <a href="{{ $hero->btn2_url }}" class="lp-btn">{{ $hero->btn2_label }}</a>
            </div>
        </div>
    </section>

    <!-- 3. FRAGRANCE COLLECTION SECTION -->
    <section class="collection-section lp-container js-observe">
        <div class="collection-header js-fade-in">
            <h2 class="section-heading">Introducing fragrance collection 26’</h2>
        </div>

        <div class="carousel-wrapper">
            <div class="carousel-controls">
                <button class="carousel-btn" id="btn-prev" aria-label="Previous">
    <img src="{{ asset('assets/images/products/prives.png') }}" alt="Previous">
</button>

<button class="carousel-btn" id="btn-next" aria-label="Next">
    <img src="{{ asset('assets/images/products/next.png') }}" alt="Next">
</button>
            </div>
            <div class="carousel-track" id="product-track">
    @foreach($featuredProducts as $product)
        @php
            $defaultImg = $product->images->firstWhere('image_type', 'default');
            $hoverImg   = $product->images->firstWhere('image_type', 'hover');
        @endphp
        <div class="product-card js-card-slide"
             onclick="window.location.href='{{ route('shop.product', $product->slug) }}'">
            <div class="product-image-wrap">
                <img src="{{ $defaultImg ? asset('storage/' . $defaultImg->image) : asset('assets/images/placeholder.png') }}"
                     alt="{{ $product->name }}"
                     class="product-image-primary" loading="lazy">
                <img src="{{ $hoverImg ? asset('storage/' . $hoverImg->image) : ($defaultImg ? asset('storage/' . $defaultImg->image) : asset('assets/images/placeholder.png')) }}"
                     alt="{{ $product->name }} Hover"
                     class="product-image-secondary" loading="lazy">
            </div>
            <div class="product-info">
                <div class="product-details">
                    <div class="product-name">{{ $product->name }}</div>
                   
                  
                </div>
                <div class="product-actions">
                    <button class="action-btn btn-wishlist" aria-label="Add to Wishlist"
                            onclick="event.stopPropagation();">
                        <img src="{{ asset('assets/images/products/wishlist.png') }}" alt="Wishlist">
                    </button>
                     <button class="action-btn btn-cart" data-product-id="{{ $product->id }}"
                                    aria-label="Add to Cart">
                                    <img src="{{ asset('assets/images/products/add_to_cart.png') }}" alt="Add to Cart">
                                </button>
                </div>
                
                
            </div>
            
             <div class="productcard_bottom">
                          <div class="product-category-hover">
                        {{ $product->sub_title ?? ($product->category->name ?? '') }}
                    </div>
                    
                     <div class="product-category-hover2">
                        ₹{{ number_format($product->price, 2) }}
                        </div>
                    </div>
        </div>
    @endforeach
</div>
        </div>
    </section>

    <!-- 5. BANNER 1 -->
    <div class="static-banner static-banner-1" @if($banner->background_image)
    style="background-image: url('{{ asset('storage/'.$banner->background_image) }}');" @endif>
        <div class="static-banner-overlay"></div>
        <h2 class="section-heading static-banner-heading">{{ $banner->heading }}</h2>
    </div>


    <!-- 6. MEN / WOMEN CATEGORY SECTION -->
    <section class="category-section  js-observe">
        <div class="category-intro text-center mb-5 mx-auto" style="max-width: 800px; padding: 40px 20px;">
            <p class="category-intro-text">
                Today's India is shaped by both tradition and modern living. La Pavone is created for those who
                appreciate quality, value thoughtful choices, and find beauty in the details that feel personal.
            </p>
        </div>
        <div class="category-grid">

            @foreach($featuredCategories as $category)

                <div class="category-block {{ $loop->odd ? 'js-slide-left' : 'js-slide-right' }}">

                    <img src="{{ $category->square_image
                ? asset('storage/' . $category->square_image)
                : asset('assets/images/categories/default.jpg') }}" alt="{{ $category->name }}" loading="lazy">

                    <div class="category-content">

                        <h3 class="category-heading  text-white">
                            {{ strtoupper($category->name) }}
                        </h3>

                        <a href="{{ route('shop.category', $category->slug) }}" class="lp-btn">
                            Shop Now
                        </a>

                    </div>

                </div>

            @endforeach

        </div>
    </section>



    <!-- 7. BANNER 2 (Testimonial) -->
    <div class="static-banner static-banner-2 mt-md-5" @if($testimonial->background_image)
    style="background-image: url('{{ asset('storage/'.$testimonial->background_image) }}');" @endif>
        <div class="testimonial-content">
            <div class="testimonial-text-wrapper">
                <div class="quote-mark">"</div>
                <h2 class="testimonial-heading">
                    {{ $testimonial->quote_line1 }}
                    <span>{{ $testimonial->quote_line2 }}</span>
                </h2>
            </div>
            <p class="testimonial-author">{{ $testimonial->author }}</p>
        </div>
    </div>

    <!-- 8. BANNER 3 — THE FRAGRANCE OF RESTRAINT -->
    <section class="audio-section  js-audio-observe" id="audio-section">
        <h2 class="section-heading">{{ $audio->heading }}</h2>

        <div class="audio-image-wrapper mt-4">
            <img src="{{ $audio->section_image ? asset('storage/'.$audio->section_image) : 'assets/images/banners/last_imgsection.png' }}"
                alt="{{ $audio->heading }}" loading="lazy">
        </div>
        <!-- Placeholder audio element, no src provided so it's empty, script will handle it gracefully -->
        <audio id="ambient-audio" loop preload="none">
            @if($audio->audio_file)
                <source src="{{ asset('storage/'.$audio->audio_file) }}" type="audio/mpeg">
            @else
                <source src="{{ asset('assets/images/home_footer_audio.mpeg')}}" type="audio/mpeg">
            @endif
        </audio>
    </section>


 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).on('click', '.btn-cart', function (e) {

            e.preventDefault();
            e.stopPropagation();

            let button = $(this);
            let productId = button.data('product-id');

            $.ajax({
                url: "{{ route('cart.add') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    quantity: 1
                },

                success: function (response) {

                    if ($('.cart-count').length) {
                        $('.cart-count').text(response.cart_count);
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Cart',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                },

                error: function (xhr) {

                    let message = 'Something went wrong';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: message
                    });
                }

            });

        });

    </script>

@endsection