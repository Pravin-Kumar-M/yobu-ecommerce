<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // User_profile's
    public function user_profile()
    {
        $user = User::findOrFail(Auth::id());
        $count = Cart::where('user_id', Auth::id())->count();
        $orders = Order::where('user_id', Auth::id())->get();


        return view('Home.home_user_profile', compact('user', 'count', 'orders'));
    }

    // privacy policy
    public function privacy_policy()
    {
        $user = Auth::user();
        return view('Home.home_privacy_policy', compact('user'));
    }

    // payment methods
    public function payment_methods()
    {
        $user = Auth::user();
        return view('Home.home_payment_methods', compact('user'));
    }

    // gift
    public function gift()
    {
        $user = Auth::user();
        return view('Home.home_gift', compact('user'));
    }
}
