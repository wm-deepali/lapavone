<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Wishlist;

class CustomerAuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('user.profile');
        }

        return view('user.login');
    }

    public function registerForm()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('user.profile');
        }

        return view('user.register');
    }

    public function register(Request $request)
    {
        if (!session('otp_verified')) {

            return response()->json([
                'status' => false,
                'message' => 'OTP verification required.'
            ]);
        }

        $validated = $request->validate(
            [
                'name' => ['required', 'max:100', 'regex:/^[A-Za-z\s]+$/'],
                'email' => ['required', 'email', 'unique:customers,email'],
                'password' => ['required', 'min:8', 'confirmed'],
            ],
            [
                'name.regex' => 'Name should contain only letters.',
                'password.confirmed' => 'Password and confirm password do not match.',
            ]
        );

        $customer = Customer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => session('register_mobile'),
            'alternate_mobile' => '9999999999',
            'password' => bcrypt($validated['password']),
        ]);

        Auth::guard('customer')->login($customer);

        $this->mergeGuestCart($customer);
        $this->mergeGuestWishlist($customer);

        session()->forget([
            'register_mobile',
            'register_otp',
            'otp_verified'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Registration successful.',
            'redirect' => route('user.profile')
        ]);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('customer')->attempt($credentials, $remember)) {

            $customer = Auth::guard('customer')->user();

            $this->mergeGuestCart($customer);
            $this->mergeGuestWishlist($customer);

            $request->session()->regenerate();

            return redirect()
                ->route('user.profile')
                ->with('success', 'Login successful.');
        }

        return back()
            ->withInput()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $customer = Customer::firstOrCreate(
            [
                'email' => $googleUser->email,
            ],
            [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => bcrypt(str()->random(20)),
                'mobile' => time(),
                'alternate_mobile' => time() + 1,
            ]
        );

        Auth::guard('customer')->login($customer);

        $this->mergeGuestCart($customer);
        $this->mergeGuestWishlist($customer);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }

    private function mergeGuestCart(Customer $customer)
    {
        $guestCart = Cart::where(
            'session_id',
            session()->getId()
        )->first();

        if (!$guestCart) {
            return;
        }

        $userCart = Cart::firstOrCreate(
            [
                'user_id' => $customer->id
            ],
            [
                'session_id' => session()->getId(),
                'total_amount' => 0
            ]
        );

        if ($guestCart->id == $userCart->id) {

            $userCart->update([
                'user_id' => $customer->id
            ]);

            return;
        }

        foreach ($guestCart->items as $item) {

            $existingItem = CartItem::where('cart_id', $userCart->id)
                ->where('product_id', $item->product_id)
                ->first();

            if ($existingItem) {

                $existingItem->quantity += $item->quantity;
                $existingItem->total =
                    $existingItem->quantity * $existingItem->price;

                $existingItem->save();

            } else {

                CartItem::create([
                    'cart_id' => $userCart->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                ]);
            }
        }

        $userCart->update([
            'total_amount' => $userCart->items()->sum('total')
        ]);

        $guestCart->items()->delete();
        $guestCart->delete();
    }

    private function mergeGuestWishlist(Customer $customer)
    {
        $guestWishlistItems = Wishlist::where(
            'session_id',
            session()->getId()
        )->get();

        if ($guestWishlistItems->isEmpty()) {
            return;
        }

        foreach ($guestWishlistItems as $item) {

            $exists = Wishlist::where(
                'customer_id',
                $customer->id
            )
                ->where(
                    'product_id',
                    $item->product_id
                )
                ->exists();

            if (!$exists) {

                Wishlist::create([
                    'customer_id' => $customer->id,
                    'session_id' => null,
                    'product_id' => $item->product_id,
                    'expires_at' => $item->expires_at,
                ]);
            }
        }

        Wishlist::where(
            'session_id',
            session()->getId()
        )->delete();
    }


    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|regex:/^[6-9]\d{9}$/'
        ]);

        $otp = rand(100000, 999999);

        session([
            'register_mobile' => $request->mobile,
            'register_otp' => $otp
        ]);

        $message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
        $dlt_id = '1307161465983326774';
        $pe_id = '1301160576431389865';
        $authkey = '133780AWLy8zZpC690b124aP1';

        $params = [
            'authkey' => $authkey,
            'mobiles' => $request->mobile,
            'sender' => 'WMINGO',
            'message' => urlencode($message),
            'route' => '4',
            'country' => '91',
            'DLT_TE_ID' => $dlt_id,
            'PE_ID' => $pe_id
        ];

        $url = "http://sms.webmingo.in/api/sendhttp.php?" . http_build_query($params);

        // Send SMS using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);


        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully'
        ]);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        if ($request->otp == session('register_otp')) {

            session([
                'otp_verified' => true
            ]);

            return response()->json([
                'status' => true,
                'message' => 'OTP verified successfully.'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid OTP'
        ]);
    }

    public function guestLogin(Request $request)
    {
        if (!session('otp_verified')) {
            return response()->json([
                'status' => false,
                'message' => 'Please verify OTP first.'
            ]);
        }

        $mobile = session('register_mobile');

        $customer = Customer::firstOrCreate(
            [
                'mobile' => $mobile
            ],
            [
                'name' => 'Guest User',
                'email' => null,
                'alternate_mobile' => '9999999999',
                'password' => bcrypt(str()->random(10))
            ]
        );

        Auth::guard('customer')->login($customer);

        $this->mergeGuestCart($customer);
        $this->mergeGuestWishlist($customer);

        return response()->json([
            'status' => true,
            'redirect' => route('home')
        ]);
    }

    public function sendLoginOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|regex:/^[6-9]\d{9}$/'
        ]);

        $customer = Customer::where('mobile', $request->mobile)->first();

        if (!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'No account found with this mobile number.'
            ]);
        }

        $otp = rand(100000, 999999);

        session([
            'login_mobile' => $request->mobile,
            'login_otp' => $otp,
        ]);

        $message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
        $dlt_id = '1307161465983326774';
        $pe_id = '1301160576431389865';
        $authkey = '133780AWLy8zZpC690b124aP1';

        $params = [
            'authkey' => $authkey,
            'mobiles' => $request->mobile,
            'sender' => 'WMINGO',
            'message' => urlencode($message),
            'route' => '4',
            'country' => '91',
            'DLT_TE_ID' => $dlt_id,
            'PE_ID' => $pe_id
        ];

        $url = "http://sms.webmingo.in/api/sendhttp.php?" . http_build_query($params);

        // Send SMS using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);

        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully'
        ]);
    }

    public function verifyLoginOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        if ($request->otp != session('login_otp')) {

            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ]);
        }

        $customer = Customer::where(
            'mobile',
            session('login_mobile')
        )->first();

        if (!$customer) {

            return response()->json([
                'status' => false,
                'message' => 'Customer not found.'
            ]);
        }

        Auth::guard('customer')->login($customer);

        $this->mergeGuestCart($customer);
        $this->mergeGuestWishlist($customer);

        session()->forget([
            'login_mobile',
            'login_otp'
        ]);

        return redirect()->route('user.profile');
    }

}
