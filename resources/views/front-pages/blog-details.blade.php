@extends('layouts.app')
@section('content')

<div class="blog-details-wrapper">

    <!-- FULL BACKGROUND COVER IMAGE -->
    <div class="blog-detail-hero">
        <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/images/product_storycard.png') }}"
             alt="{{ $blog->title }}" class="blog-hero-cover-img"
             onerror="this.onerror=null; this.src='{{ asset('assets/images/product_slider_1.png') }}';">
    </div>

    <!-- OVERLAPPING CONTENT CONTAINER -->
    <section class="blog-detail-content-section">
        <div class="lp-container d-flex justify-content-center">
            <div class="blog-detail-container">

                <!-- Meta and Title Block -->
                <div class="blog-detail-meta">
                    {{ $blog->created_at->format('F d, Y') }}
                </div>
                <h1 class="blog-detail-title">{{ strtoupper($blog->title) }}</h1>

                @if($blog->short_description)
                    <h2 class="blog-detail-subtitle">{{ strtoupper($blog->short_description) }}</h2>
                @endif

                <!-- Main Content -->
                <div class="blog-detail-body">
                    <div class="blog-detail-paragraph">
                        {!! $blog->content !!}
                    </div>
                </div>

                <!-- Social Share Section -->
                <div class="blog-share-section">
                    <span class="share-title">Share this article:</span>
                    <div class="share-icons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                           target="_blank" aria-label="Share on Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}"
                           target="_blank" aria-label="Share on Twitter">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->fullUrl()) }}"
                           target="_blank" aria-label="Share on WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(request()->fullUrl()) }}&description={{ urlencode($blog->title) }}"
                           target="_blank" aria-label="Share on Pinterest">
                            <i class="fa-brands fa-pinterest-p"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- READ MORE SECTION -->
    @if($relatedBlogs->isNotEmpty())
        <section class="blog-read-more-dark">
            <div class="lp-container">
                <h2 class="blog-read-more-title">READ MORE</h2>
                <div class="row g-4">
                    @foreach($relatedBlogs as $related)
                        <div class="col-12 col-md-6">
                            <a href="{{ route('blog.details', $related->slug) }}" class="read-more-card">
                                <div class="read-more-img-wrap">
                                    <img src="{{ $related->image ? asset('storage/' . $related->image) : asset('assets/images/product_storycard.png') }}"
                                         alt="{{ $related->title }}" class="read-more-img"
                                         onerror="this.onerror=null; this.src='{{ asset('assets/images/product_storycard.png') }}';">
                                </div>
                                <h3 class="read-more-card-title">{{ strtoupper($related->title) }}</h3>
                                @if($related->short_description)
                                    <p class="read-more-excerpt">{{ $related->short_description }}</p>
                                @endif
                                <span class="read-more-link">Read more</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</div>

@endsection