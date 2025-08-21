<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            // Cart
            $cartItems = Auth::check()
                ? Cart::with('product')->where('user_id', Auth::id())->get()
                : Cart::with('product')->where('session_id', session()->getId())->whereNull('user_id')->get();

            $cartCount = $cartItems->sum('quantity');

            $cartTotal = $cartItems->sum(function ($cart) {
                return $cart->product ? $cart->product->store_price * $cart->quantity : 0;
            });

            // Notifications (for logged-in users)
            $unreadCount = 0;
            $unreadNotifications = collect();

            if (Auth::check()) {
                // use relation for efficient count and list
                $unreadCount = Auth::user()->unreadNotifications()->count();
                $unreadNotifications = Auth::user()
                    ->unreadNotifications()
                    ->latest()
                    ->limit(10)
                    ->get();
            }

            $view->with([
                'count'              => $cartCount,
                'cart_total'         => number_format($cartTotal, 2),
                'carts'              => $cartItems,
                'unreadCount'        => $unreadCount,
                'unreadNotifications' => $unreadNotifications,
            ]);
        });
    }
}
