<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{


    // add to cart
    public function add_cart(Request $request, $id)
    {
        $product_id = $id;
        $session_id = Session::getId();
        $quantity = $request->input('quantity', 1);
        $user_id = Auth::check() ? Auth::id() : null;

        // Handle custom image (if sent)
        $customImageData = $request->input('customImage');
        $customImagePath = null;

        if (!empty($customImageData)) {
            // Make sure the directory exists
            $dir = public_path('img/custom_image');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            // Clean up and decode base64 image
            $image = str_replace('data:image/png;base64,', '', $customImageData);
            $image = str_replace(' ', '+', $image);

            $imageName = 'custom_' . time() . '.png';
            $imagePath = $dir . '/' . $imageName;

            file_put_contents($imagePath, base64_decode($image));

            // Store relative path (for easy asset() usage)
            $customImagePath = 'img/custom_image/' . $imageName;
        }

        // Check if product already exists in cart
        $cartQuery = Cart::where('product_id', $product_id);

        if ($user_id) {
            $cartQuery->where('user_id', $user_id);
        } else {
            $cartQuery->where('session_id', $session_id)->whereNull('user_id');
        }

        if ($customImagePath) {
            $cartQuery->where('custom_image', $customImagePath);
        } else {
            $cartQuery->whereNull('custom_image');
        }

        $cart = $cartQuery->first();

        // Update or create cart entry
        if ($cart) {
            $cart->quantity += $quantity;
        } else {
            $cart = new Cart;
            $cart->product_id = $product_id;
            $cart->quantity = $quantity;
            $cart->custom_image = $customImagePath; // can be null
            $cart->session_id = $session_id;
            $cart->user_id = $user_id;
        }

        $cart->save();

        toastr()
            ->closeButton()
            ->positionClass('toast-top-center')
            ->addSuccess('Cart added successfully!');

        // Redirect to the cart route, not view file path
        return redirect()->back();
    }

    // view cart
    public function view_cart()
    {
        $session_id = session()->getId(); // Step 1: Get current session ID

        if (Auth::check()) {
            $user_id = Auth::id();

            // Step 2: Merge guest cart with user cart on login
            Cart::where('session_id', $session_id)
                ->whereNull('user_id')
                ->update(['user_id' => $user_id]);

            // Step 3: Get all carts for this user (logged in)
            $carts = Cart::with('product')
                ->where('user_id', $user_id)
                ->get();
        } else {
            // Step 4: Guest user - fetch cart by session only
            $carts = Cart::with('product')
                ->where('session_id', $session_id)
                ->whereNull('user_id') // make sure not linked to a user
                ->get();
        }

        // Step 5: Send to view
        return view('Home.home_view_cart', compact('carts'));
    }

    // update cart quantity
    public function update_cart(Request $request)
    {
        $quantities = $request->input('quantities');
        $session_id = Session::getId();

        if (empty($quantities)) {
            toastr()->closeButton()->positionClass('toast-top-center')->addWarning('Your cart is empty. Start shopping!');
            return redirect('shop');
        }

        foreach ($quantities as $cartId => $qty) {
            if (Auth::check()) {
                $cart = Cart::where('id', $cartId)
                    ->where('user_id', Auth::id())
                    ->first();
            } else {
                $cart = Cart::where('id', $cartId)
                    ->where('session_id', $session_id)
                    ->whereNull('user_id')
                    ->first();
            }

            if (!$cart) continue;

            $product = Product::find($cart->product_id);

            if ($product && $qty <= $product->quantity) {
                $cart->quantity = $qty;
                $cart->save();
            } elseif ($product) {
                toastr()->closeButton()->positionClass('toast-top-center')->addError('Not enough stock for ' . $product->name);
                return redirect()->back();
            }
        }

        toastr()->closeButton()->positionClass('toast-top-center')->addSuccess('Cart updated successfully!');
        return redirect()->route('view_cart');
    }

    // delete cart item
    public function delete_cart($id)
    {
        $session_id = Session::getId();

        if (Auth::check()) {
            $cart = Cart::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();
        } else {
            $cart = Cart::where('id', $id)
                ->where('session_id', $session_id)
                ->whereNull('user_id')
                ->first();
        }

        if ($cart) {
            $cart->delete();
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addSuccess('Cart item deleted successfully!');
        } else {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addError('Cart item not found or access denied!');
        }

        return redirect()->back();
    }

    // checkout page
    public function checkout()
    {
        $user_id = Auth::id();
        $session_id = session()->getId();

        if ($user_id) {
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $carts = Cart::where('session_id', $session_id)->get();
        }

        if ($carts->isEmpty()) {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addError('Your cart is empty!');
            return redirect()->route('products');
        }

        $user = $user_id ? User::find($user_id) : null;

        if ($user_id && !$user) {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addError('User not found!');
            return redirect()->route('products');
        }

        $count = $carts->count();

        return view('Home.home_checkout', compact('carts', 'user', 'count'));
    }

    // confirm_order
    public function confirmOrder(Request $request)
    {
        // Save customer info to session
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

        if ($request->payment_method === 'visa') {
            return redirect()->route('stripe');
        }

        $user_id = Auth::id();
        $session_id = session()->getId();

        // Get all cart items (for both logged-in & guest users)
        $carts = Cart::with('product')
            ->where(function ($query) use ($user_id, $session_id) {
                if ($user_id) {
                    $query->where('user_id', $user_id)
                        ->orWhere('session_id', $session_id);
                } else {
                    $query->where('session_id', $session_id)->whereNull('user_id');
                }
            })->get();

        foreach ($carts as $cart) {

            // Reduce product quantity
            $product = Product::find($cart->product_id);

            if ($product) {
                // Prevent negative stock
                if ($product->quantity >= $cart->quantity) {
                    $product->quantity -= $cart->quantity;
                } else {
                    $product->quantity = 0;
                }
                $product->save();
            }

            // Save order
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
            $order->product_id = $cart->product_id;
            $order->quantity = $cart->quantity;
            $order->total_amount = $cart->product->store_price * $cart->quantity;
            $order->payment_method = session('payment_method');
            $order->payment_status = 'pending';
            $order->custom_image = $cart->custom_image;
            $order->save();
        }

        // Delete cart items after order
        if ($user_id) {
            Cart::where('user_id', $user_id)->delete();
        } else {
            Cart::where('session_id', $session_id)->whereNull('user_id')->delete();
        }

        toastr()->closeButton()->positionClass('toast-top-center')->addSuccess('Order placed successfully!');
        return redirect('/');
    }
}
