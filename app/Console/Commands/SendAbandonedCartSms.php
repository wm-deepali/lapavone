<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;
use App\Services\Sms\SmsDispatcher;

class SendAbandonedCartSms extends Command
{
    protected $signature = 'sms:abandoned-cart';

    protected $description = 'Send SMS reminders for abandoned carts';

    public function handle(): int
    {
        $carts = Cart::with('user')
            ->whereNotNull('user_id')
            ->where('grand_total', '>', 0)
            ->where('updated_at', '<=', now()->subHours(24))
            ->get();

        foreach ($carts as $cart) {

            if (!$cart->user || !$cart->user->mobile) {
                continue;
            }

            SmsDispatcher::send('abandoned-cart', $cart->user->mobile, [
                '{customer_name}' => $cart->user->name,
                '{cart_value}'    => '₹' . number_format($cart->grand_total, 2),
                '{cart_link}'     => route('cart.index'),
                '{coupon_code}'   => $cart->coupon_code ?: '',
                '{brand_name}'    => config('app.name'),
            ]);

            $this->info("SMS sent for cart #{$cart->id}");
        }

        return self::SUCCESS;
    }
}