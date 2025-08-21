<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Notifications\EcommerceNotification;
use App\Notifications\OrderPlacedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe;


class PaymentController extends Controller
{

    // Stripe payment
    public function stripe(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        // Save user info to session
        session([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'payment_method' => $request->payment_method,
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect('/')->back()->with('error', 'Your cart is empty.');
        }

        $lineItems = [];

        foreach ($cartItems as $cart) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $cart->product->name,
                    ],
                    'unit_amount' => $cart->product->store_price * 100,
                ],
                'quantity' => $cart->quantity,
            ];
        }

        $session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($session->url);
    }

    // success 

    public function success()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->with('product')->get();

        if ($carts->isEmpty()) {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addError('Your cart is Empty!');
            return redirect('/');
        }

        DB::transaction(function () use ($user_id, $carts) {
            // ✅ Create one order record
            $order = new Order;
            $order->first_name = session('first_name');
            $order->last_name = session('last_name');
            $order->country = session('country');
            $order->address = session('address');
            $order->city = session('city');
            $order->state = session('state');
            $order->zip_code = session('zip_code');
            $order->phone = session('phone');
            $order->email = session('email');
            $order->user_id = $user_id;
            $order->product_id = $carts->first()->product_id;
            $order->custom_image = $carts->first()->custom_image;
            $order->payment_method = session('payment_method');
            $order->payment_status = 'paid';
            $order->total_amount = $carts->sum(fn($cart) => $cart->product->store_price * $cart->quantity);
            $order->save();

            //  Save order items separately
            foreach ($carts as $cart) {
                $order->items()->create([
                    'product_id'   => $cart->product_id,
                    'quantity'     => $cart->quantity,
                    'price'        => $cart->product->store_price,
                    'custom_image' => $cart->custom_image,
                ]);
            }


            // Notify customer
            $user = User::find($user_id);
            $user->notify(new EcommerceNotification($order));

            $admin = User::where('usertype', 'admin')->first();
            Notification::send([$user, $admin], new OrderPlacedNotification($order));


            // ✅ Clear cart
            Cart::where('user_id', $user_id)->delete();
        });

        toastr()
            ->closeButton()
            ->positionClass('toast-top-center')
            ->addSuccess('Order placed successfully!');

        return redirect('/');
    }

    // paypal payment
    public function paypal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $provider->setAccessToken($paypalToken);

        // Save user info to session
        session()->put([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'payment_method' => $request->payment_method,
        ]);


        // Fetch cart items
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate total
        $total = 0;
        foreach ($cartItems as $cart) {
            $total += $cart->product->store_price * $cart->quantity;
        }

        // Create PayPal Order
        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.paypal_success'),
                "cancel_url" => route('paypal.paypal_cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($total, 2, '.', ''),
                    ]
                ]
            ]
        ]);

        if (isset($order['id']) && $order['status'] == 'CREATED') {
            foreach ($order['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        toastr()
            ->closeButton()
            ->positionClass('toast-top-center')
            ->addError('Something went wrong with PayPal. Please try again.');

        return redirect()->back();
    }

    // paypal success
    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));

        $token = $request->query('token'); // PayPal order ID from query string

        if (!$token) {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addError('Missing PayPal token!');
            return redirect('/');
        }

        $result = $provider->capturePaymentOrder($token);

        if (isset($result['status']) && $result['status'] === 'COMPLETED') {
            $user_id = Auth::id();
            $carts = Cart::where('user_id', $user_id)->with('product')->get();

            if ($carts->isEmpty()) {
                toastr()
                    ->closeButton()
                    ->positionClass('toast-top-center')
                    ->addError('Your cart is Empty!');
                return redirect('/');
            }

            DB::transaction(function () use ($user_id, $carts) {
                // Create one order record (same as Stripe success)
                $order = new Order;
                $order->first_name = session('first_name');
                $order->last_name = session('last_name');
                $order->country = session('country');
                $order->address = session('address');
                $order->city = session('city');
                $order->state = session('state');
                $order->zip_code = session('zip_code');
                $order->phone = session('phone');
                $order->email = session('email');
                $order->user_id = $user_id;
                $order->product_id = $carts->first()->product_id; // representative product
                $order->payment_method = session('payment_method'); // PayPal
                $order->payment_status = 'paid';
                $order->total_amount = $carts->sum(fn($cart) => $cart->product->store_price * $cart->quantity);
                $order->save();

                // Save order items separately
                foreach ($carts as $cart) {
                    $order->items()->create([
                        'product_id'   => $cart->product_id,
                        'quantity'     => $cart->quantity,
                        'price'        => $cart->product->store_price,
                        'custom_image' => $cart->custom_image,
                    ]);
                }

                // Send notifications
                $user = User::find($user_id);
                $user->notify(new EcommerceNotification($order));

                $admin = User::where('usertype', 'admin')->first();
                Notification::send([$user, $admin], new OrderPlacedNotification($order));

                // Clear the cart
                Cart::where('user_id', $user_id)->delete();
            });

            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addSuccess('Order placed successfully via PayPal!');

            return redirect('/');
        } else {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addError('Payment failed or was not completed!');
            return redirect('/');
        }
    }


    // paypal cancel    
    public function cancel(Request $request)
    {
        toastr()
            ->closeButton()
            ->positionClass('toast-top-center')
            ->addWarning('You have cancelled the PayPal payment.');

        return redirect('/');
    }
}
