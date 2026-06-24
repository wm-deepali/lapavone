@extends('layouts.app')
@section('content')

    @php
        $bannerImages = $product->images->where('image_type', 'banner')->values();
        $defaultImg = $product->images->firstWhere('image_type', 'default');
        $storyImg = $product->images->firstWhere('image_type', 'story'); // ← add

        if ($bannerImages->isEmpty() && $defaultImg) {
            $bannerImages = collect([$defaultImg]);
        }

        $notes = null;
        if ($product->product_notes) {
            $decoded = json_decode($product->product_notes, true);
            $notes = is_array($decoded) ? $decoded : null;
        }
    @endphp

    <div class="product-page-wrapper">

        <!-- PRODUCT HERO SLIDER -->
        <section class="product-hero-slider split-slider">
            <div class="product-slider-half">
                <div class="product-slider-container" id="product-slider-right">
                    @forelse($bannerImages as $img)
                        <div class="product-slide">
                            <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $product->name }}">
                        </div>
                    @empty
                        <div class="product-slide">
                            <img src="{{ asset('assets/images/placeholder.png') }}" alt="{{ $product->name }}">
                        </div>
                    @endforelse
                </div>
                @if($bannerImages->count() > 1)
                    <div class="carousel-controls" style="top: 50%; padding: 0 40px;">
                        <button class="control-btn" style="pointer-events: auto;" id="ps-prev-right" aria-label="Previous">
                            <img src="{{ asset('assets/images/white_prives_icon.png') }}" alt="Previous">
                        </button>
                        <button class="control-btn" style="pointer-events: auto;" id="ps-next-right" aria-label="Next">
                            <img src="{{ asset('assets/images/white_next_icon.png') }}" alt="Next">
                        </button>
                    </div>
                @endif
            </div>
        </section>

        <!-- SLIDER DOTS -->
        @if($bannerImages->count() > 1)
            <div class="slider-dots-container" style="text-align: center; padding: 20px 0; background: #fff;">
                <div class="slider-dots" id="ps-dots-right"
                    style="position: static; transform: none; display: inline-flex; justify-content: center;">
                    @foreach($bannerImages as $i => $img)
                        <span class="dot {{ $i === 0 ? 'active' : '' }}"></span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- PRODUCT DETAILS SECTION -->
        <section class="product-details-section">
            <div class="lp-container">
                <div class="product-details-grid">
                    <div class="details-left">
                        <div class="product-header">
                            <h1 class="product-title">
                                {{ $product->name }}
                                @if($product->weight)
                                    <span class="product-size">{{ $product->weight }}ml</span>
                                @endif
                            </h1>
                            @if($product->sub_title)
                                <p class="product-subtitle">{{ $product->sub_title }}</p>
                            @endif
                        </div>

                        <div class="details-right">
                            <div class="product-price">₹{{ number_format($product->price, 2) }}</div>
                            <button class="btn-add-bag" data-product-id="{{ $product->id }}">
                                <span class="bag-default" style="display: flex; align-items: center; gap: 8px;">
                                    <img src="{{ asset('assets/images/products/add_to_cart.png') }}" alt="Bag"
                                        class="bag-icon"> Add To Bag
                                </span>
                                <span class="bag-active" style="display: none; align-items: center; gap: 8px;">
                                    <svg class="cart-icon" width="16" height="16" viewBox="0 0 24 24" fill="#1F5552"
                                        stroke="#1F5552" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                    </svg> In Bag
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="product-accordions">

                        @if($product->description)
                            <div class="accordion-item">
                                <div class="accordion-header">DESCRIPTION <i class="fa-solid fa-chevron-down"></i></div>
                                <div class="accordion-body" style="display:block;" <p>
                                    {!!  $product->description !!} </p>
                                </div>
                            </div>
                        @endif

                        @if($product->product_notes)
                            <div class="accordion-item">
                                <div class="accordion-header">NOTES <i class="fa-solid fa-chevron-down"></i></div>
                                <div class="accordion-body">
                                    <p>{!! $product->product_notes !!}</p>
                                </div>
                            </div>
                        @endif

                        @if($product->how_to_use)
                            <div class="accordion-item">
                                <div class="accordion-header">HOW TO USE <i class="fa-solid fa-chevron-down"></i></div>
                                <div class="accordion-body">
                                    <p>{!!  $product->how_to_use !!}</p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>

        <!-- THE STORY SECTION -->
        @if($product->the_story)
            <section class="product-story-section">
                <div class="lp-container text-center">
                    <h2 class="story-heading">THE STORY</h2>
                    <p class="story-text">{!! nl2br(e($product->the_story)) !!}</p>
                </div>
                {{-- Use dedicated story image, fallback to second banner, fallback to default --}}
                @php $displayStoryImg = $storyImg ?? $bannerImages->skip(1)->first() ?? $defaultImg; @endphp
                @if($displayStoryImg)
                    <div class="story-img-container">
                        <img src="{{ asset('storage/' . $displayStoryImg->image) }}" alt="The Story" class="story-full-img">
                    </div>
                @endif
            </section>
        @endif

        <!-- SIMILAR FRAGRANCES SECTION -->
        @if($similarProducts->isNotEmpty())
            <section class="similar-fragrances-section">
                <div class="lp-container">
                    <div class="section-header-flex">
                        <h2 class="section-heading text-left" style="margin-bottom:0;">SIMILAR FRAGRANCES</h2>
                    </div>

                    <div class="carousel-wrapper" style="margin-top: 30px;">
                        <div class="carousel-controls">
                            <button class="carousel-btn" id="btn-similar-prev" aria-label="Previous">
                                <img src="{{ asset('assets/images/products/prives.png') }}" alt="Previous">
                            </button>
                            <button class="carousel-btn" id="btn-similar-next" aria-label="Next">
                                <img src="{{ asset('assets/images/products/next.png') }}" alt="Next">
                            </button>
                        </div>
                        <div class="carousel-track" id="similar-track">
                            @foreach($similarProducts as $similar)
                                @php
                                    $simDefault = $similar->images->firstWhere('image_type', 'default');
                                    $simHover = $similar->images->firstWhere('image_type', 'hover');
                                @endphp
                                <div class="product-card is-visible"
                                    onclick="window.location.href='{{ route('shop.product', $similar->slug) }}'">
                                    <div class="product-image-wrap">
                                        <img src="{{ $simDefault ? asset('storage/' . $simDefault->image) : asset('assets/images/placeholder.png') }}"
                                            alt="{{ $similar->name }}" class="product-image-primary" loading="lazy">
                                        <img src="{{ $simHover ? asset('storage/' . $simHover->image) : ($simDefault ? asset('storage/' . $simDefault->image) : asset('assets/images/placeholder.png')) }}"
                                            alt="{{ $similar->name }} Hover" class="product-image-secondary" loading="lazy">
                                    </div>
                                    <div class="product-info">
                                        <div class="product-details">
                                            <div class="product-name">{{ $similar->name }}</div>
                                            <div class="product-price-card">₹{{ number_format($similar->price, 0) }}</div>
                                        </div>
                                        <div class="product-actions">
                                            <button class="action-btn btn-wishlist" aria-label="Add to Wishlist"
                                                onclick="event.stopPropagation();">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666"
                                                    stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button class="action-btn btn-add" aria-label="Add" onclick="event.stopPropagation();">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666"
                                                    stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- FAQS SECTION -->
        <section class="faqs-section">
            <div class="lp-container">
                <h2 class="faq-main-heading">FAQs</h2>
                <div class="faq-accordion-list">
                    @forelse($faqs as $faq)
                        <div class="faq-item">
                            <div class="faq-header">
                                {{ $faq->question }} <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="faq-body">{{ $faq->answer }}</div>
                        </div>
                    @empty
                        {{-- fallback: section simply won't show if no FAQs --}}
                    @endforelse
                </div>
            </div>
        </section>

    </div>

@endsection