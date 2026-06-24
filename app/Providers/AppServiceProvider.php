<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
use App\Models\DynamicPage;
use App\Models\Announcement;
use App\Models\Collection;
use App\Models\GiftingOccasion;
use App\Models\Category;
use App\Models\Attribute;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {

            $sessionId = session()->getId();

            $cart = Cart::with([
                'items.product.images',
                'items'
            ])
                ->where('session_id', $sessionId)
                ->first();

            $count = $cart ? $cart->items->count() : 0;


            $headerCategories = Category::with('children')
                ->whereNull('parent_id')
                ->where('status', 1)
                ->orderBy('sort_order')
                ->get();

                $collections = Collection::where('show_in_navigation', 1)
    ->where('status', 1)
    ->orderBy('sort_order')
    ->get();


            $pages = DynamicPage::where('status', 1)->get();

            $general = \App\Models\Setting::first();

            $view->with(
                [
                    'globalCartCount' => $count,
                    'miniCart' => $cart,
                    'headerCollections' => $collections,
                    'headerCategories' => $headerCategories,
                    'general' => $general,
                    'footerPages' => $pages
                ]
            );
        });




        View::composer('*', function ($view) {

            $wishlistCount = \App\Models\Wishlist::where(
                'session_id',
                session()->getId()
            )->count();
            $view->with(
                'wishlistCount',
                $wishlistCount
            );
        });



    }
}
