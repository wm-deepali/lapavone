@extends('layouts.app')
@section('content')

    <div class="faq-page-wrapper">
        <!-- FAQ HERO SECTION -->
        <section class="faq-hero-section">
            <div class="lp-container">
                <h1>FREQUENTLY ASKED QUESTIONS</h1>
                <p>Everything you need to know about La Pavone and our luxury fragrances.</p>
            </div>
        </section>

        <!-- FAQS SECTION -->
        <section class="faqs-section">
            <div class="lp-container">
                <div class="faq-accordion-list">
                    @forelse($faqs as $faq)
                        <div class="faq-item">
                            <div class="faq-header">
                                {{ $faq->question }} <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="faq-body">{{ $faq->answer }}</div>
                        </div>
                    @empty
                        <p style="text-align:center;color:#888;padding:40px 0;">No FAQs available at the moment.</p>
                    @endforelse
                </div>
            </div>

        </section>

    </div>

@endsection