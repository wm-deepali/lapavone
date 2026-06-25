@extends('layouts.app')

@section('content')

<main class="terms-page-content">
    <div class="lp-container terms-container">

        <!-- Header -->
        <div class="terms-header text-center">
            <h1>{{ $page->heading }}</h1>
             <p>Last Updated: {{ $page->updated_at->format('d F, Y') }}</p>
             
            <div class="terms-header-divider"></div>
        </div>

        <!-- Content -->
        <div class="terms-sections">
            {!! $page->content !!}
        </div>

    </div>
</main>

@endsection
