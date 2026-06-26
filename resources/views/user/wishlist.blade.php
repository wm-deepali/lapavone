@extends('layouts.app')
@section('content')

    <div class="dashboard-page-wrapper">
        <section class="dashboard-section">
            <div class="lp-container">
                <div class="dashboard-layout">

                    @include('user._sidebar')

                    <!-- Dashboard Main Content -->
                    <main class="dashboard-main">
                        <button class="dashboard-sidebar-toggle"><i class="fa-solid fa-bars"></i> Menu</button>

                        <div class="orders-header dashboard-content-header">
                            <h1 class="orders-title">MY WISHLIST</h1>
                            <p class="orders-subtitle">
                                Items you've saved for later
                                @if($wishlists->isNotEmpty())
                                    <span style="font-size:13px;color:#888;margin-left:6px;">({{ $wishlists->count() }}
                                        {{ Str::plural('item', $wishlists->count()) }})</span>
                                @endif
                            </p>
                        </div>

                        @if($wishlists->isEmpty())
                            {{-- Empty State --}}
                            <div style="text-align:center;padding:60px 20px;">
                                <i class="fa-regular fa-heart"
                                    style="font-size:52px;color:#d0cdc8;margin-bottom:20px;display:block;"></i>
                                <h3 style="font-family:'Cinzel',serif;color:#1F5552;margin-bottom:10px;font-size:18px;">Your
                                    wishlist is empty</h3>
                                <p style="font-family:'Outfit',sans-serif;font-size:14px;color:#888;margin-bottom:24px;">Save
                                    items you love and come back to them anytime.</p>
                                <a href="{{ route('home') }}" class="lp-btn lp-btn-solid"
                                    style="padding:10px 28px;font-size:14px;">Explore Products</a>
                            </div>
                        @else
                            <div class="wishlist-grid">
                                @foreach($wishlists as $wishlist)
                                    @php $product = $wishlist->product; @endphp
                                    @if(!$product) @continue @endif

                                    <div class="product-card is-visible" id="wishlist-card-{{ $product->id }}">
                                        <div class="product-image-wrap">
                                            <a href="{{ route('shop.product', $product->slug) }}">
                                                <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image) : asset('assets/images/placeholder.png') }}"
                                                    alt="{{ $product->name }}" class="product-image-primary" loading="lazy">
                                            </a>
                                            <button class="wishlist-remove-btn" aria-label="Remove from Wishlist"
                                                data-product-id="{{ $product->id }}"
                                                onclick="removeFromWishlist({{ $product->id }}, this)">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>

                                        <div class="product-info">
                                            <div class="product-details">
                                                <a href="{{ route('shop.product', $product->slug) }}"
                                                    style="text-decoration:none;color:inherit;">
                                                    <div class="product-name">{{ $product->name }}</div>
                                                </a>
                                                <div class="product-price-card">
                                                    ₹{{ number_format($product->selling_price ?? $product->price, 0) }}
                                                </div>
                                            </div>
                                            <div class="product-actions">
                                                <button class="lp-btn lp-btn-solid add-to-cart-btn"
                                                    style="padding:10px 16px;font-size:14px;width:100%;"
                                                    data-product-id="{{ $product->id }}"
                                                    onclick="moveToCart({{ $product->id }}, this)">
                                                    Move to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </main>
                </div>
            </div>
        </section>
    </div>

    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]').content;

        function removeFromWishlist(productId, btn) {
            btn.disabled = true;

            fetch(`/wishlist/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                },
            })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        if (data.wishlist_count !== undefined) {
                            $('.wishlist-count').text(data.wishlist_count);
                        }
                        const card = document.getElementById('wishlist-card-' + productId);
                        card.style.transition = 'opacity 0.3s, transform 0.3s';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            card.remove();
                            checkEmpty();
                        }, 300);
                    } else {
                        btn.disabled = false;
                        Swal.fire({ icon: 'error', title: 'Oops...', text: data.message || 'Could not remove item.', confirmButtonColor: '#1F5552' });
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong. Please try again.', confirmButtonColor: '#1F5552' });
                });
        }

        function moveToCart(productId, btn) {
            btn.disabled = true;
            btn.textContent = 'Moving...';

            fetch(`/wishlist/${productId}/move-to-cart`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                },
            })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {

                        if (data.wishlist_count !== undefined) {
                            $('.wishlist-count').text(data.wishlist_count);
                        }

                        if (data.cart_count !== undefined) {
                            $('.cart-count').text(data.cart_count);
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Moved to Cart',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        const card = document.getElementById('wishlist-card-' + productId);
                        card.style.transition = 'opacity 0.3s, transform 0.3s';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            card.remove();
                            checkEmpty();
                        }, 300);
                    } else {
                        btn.disabled = false;
                        btn.textContent = 'Move to Cart';
                        Swal.fire({ icon: 'error', title: 'Oops...', text: data.message || 'Could not move item.', confirmButtonColor: '#1F5552' });
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    btn.textContent = 'Move to Cart';
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong. Please try again.', confirmButtonColor: '#1F5552' });
                });
        }

        function checkEmpty() {
            const grid = document.querySelector('.wishlist-grid');
            if (grid && grid.children.length === 0) {
                grid.outerHTML = `
                            <div style="text-align:center;padding:60px 20px;">
                                <i class="fa-regular fa-heart" style="font-size:52px;color:#d0cdc8;margin-bottom:20px;display:block;"></i>
                                <h3 style="font-family:'Cinzel',serif;color:#1F5552;margin-bottom:10px;font-size:18px;">Your wishlist is empty</h3>
                                <p style="font-family:'Outfit',sans-serif;font-size:14px;color:#888;margin-bottom:24px;">Save items you love and come back to them anytime.</p>
                                <a href="{{ route('home') }}" class="lp-btn lp-btn-solid" style="padding:10px 28px;font-size:14px;">Explore Products</a>
                            </div>`;
            }
        }
    </script>

@endsection