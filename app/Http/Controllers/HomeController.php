<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::where('usertype', 'user')->get()->count();
        $products = Product::all()->count();
        $orders = Order::all()->count();
        $delivered = Order::where('order_status', 'Delivered')->get()->count();

        return view('Admin.index', compact('users', 'products', 'orders', 'delivered'));
    }

    public function home()
    {
        $products = Product::all();
        return view('Home.home_index', compact('products'));
    }


    public function user_dashboard()
    {
        $products = Product::all();

        $count = Cart::where('user_id', Auth::id())->count();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

        return view('Home.home_index', compact('products', 'count', 'wishlistCount'));
    }

    // Product details
    public function product_details($slug)
    {
        $products = Product::where('slug', $slug)->get()->first();

        if (Auth::check()) {
            // Logged-in user cart count
            $count = Cart::where('user_id', Auth::id())->count();
        } else {
            // Guest cart count based on session ID
            $count = Cart::where('session_id', session()->getId())->count();
        }

        return view('Home.home_product_details', compact('products', 'count'));
    }

    // Shop page
    public function shop_page()
    {
        $products = Product::all();

        return view('Home.home_shop_page', compact('products'));
    }

    // about page
    public function about()
    {
        return view('Home.home_about');
    }

    // blog page
    public function blog()
    {
        return view('Home.home_blog');
    }

    // contact page
    public function contact()
    {
        return view('Home.home_contact');
    }

    // blog detail page
    public function blog_detail()
    {
        return view('Home.home_blog_detail');
    }

    // wishlist page
    public function add_to_wishlist(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'unauthenticated',
                'message' => 'Please login to add items to wishlist'
            ]);
        }

        $productId = $request->input('product_id');

        if (Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->exists()) {
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
            return response()->json([
                'status' => 'exists',
                'message' => 'Product already in wishlist',
                'wishlistCount' => $wishlistCount
            ]);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

        return response()->json([
            'status' => 'success',
            'message' => 'Added to wishlist',
            'wishlistCount' => $wishlistCount
        ]);
    }


    // view_wishlist
    public function view_wishlist()
    {
        if (Auth::check()) {
            $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
            $count = Cart::where('user_id', Auth::id())->count();
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            $wishlistItems = collect(); // empty collection
            $count = 0;
            $wishlistCount = 0;
        }

        return view('Home.home_view_wishlist', compact('wishlistItems', 'count', 'wishlistCount'));
    }


    // delete wishlist
    public function deleteWishlist($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        if ($wishlist->user_id === Auth::id()) {
            $wishlist->delete();
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addSuccess('Item removed from wishlist');
            return redirect()->back();
        }

        return redirect()->back()->with('error', 'Unauthorized action');
    }

    // google login
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    // google authentication
    public function googleAuth()
    {
        try {
            $googleUser = Socialite::driver('google')->user();       // stateless()->


            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create new user
                $user = User::create([
                    'name'     => $googleUser->getName(),
                    'email'    => $googleUser->getEmail(),
                    'usertype' => 'user',
                    'password' => bcrypt(uniqid()), // random password since Google login skips password
                ]);
            }

            // Log the user in
            Auth::login($user);

            // Redirect to dashboard or wherever you want
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addSuccess('Registration Successfully !');

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }

    // displayCategories

    public function shopPage(Request $request)
    {
        $categories = Category::all();

        if ($request->has('category') && $request->category != '') {
            $products = Product::where('category', $request->category)->paginate(3);
        } else {
            $products = Product::paginate(3);
        }

        return view('home.home_shop_page', compact('categories', 'products'));
    }


    // FAQ's
    public function faq()
    {
        return view('Home.home_faq');
    }
}
