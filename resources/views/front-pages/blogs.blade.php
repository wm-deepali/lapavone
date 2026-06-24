@extends('layouts.app')
@section('content')

    <div class="blog-page-wrapper">

        <!-- 2. BLOG HERO HEADER BANNER -->
        <section class="blog-hero-section-clean">
            <div class="lp-container text-center">
                <div class="blog-breadcrumbs" id="blog-breadcrumbs">Home / Blog</div>
                <h1 class="blog-main-title" id="blog-main-title">THE PAVONE DIARIES</h1>
            </div>
        </section>

        <!-- 3. BLOG CARDS SECTION -->
        <section class="blog-grid-section">
            <div class="lp-container">
                <div class="row g-5 justify-content-center">
                    @forelse($blogs as $blog)
                        <div class="col-12 col-md-4">
                            <div class="blog-post-card"
                                onclick="window.location.href='{{ route('blog.details', $blog->slug) }}'">
                                <div class="blog-image-wrap">
                                    <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/images/placeholder.png') }}"
                                        alt="{{ $blog->title }}" class="blog-img">
                                </div>
                                <div class="blog-post-info">
                                    <h2 class="blog-post-title">{{ strtoupper($blog->title) }}</h2>
                                    @if($blog->short_description)
                                        <p class="blog-post-excerpt">{{ $blog->short_description }}</p>
                                    @endif
                                    <a href="{{ route('blog.details', $blog->slug) }}" class="blog-post-readmore">Read more</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center" style="padding:60px 20px;color:#888;">
                            <p style="font-size:18px;">No blogs found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>


    </div>
@endsection