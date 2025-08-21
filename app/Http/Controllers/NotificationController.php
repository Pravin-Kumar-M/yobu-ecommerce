<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Notifications\EcommerceNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    // email notification
    public function index()
    {
        $users = User::get();

        $post = [
            'title' => 'post-title',
            'slug' => 'post-slug'
        ];
        foreach ($users as $user) {
            $user->notify(new EcommerceNotification($post));
        }
        dd('Success');
    }

    // notification icon in header
    public function mark_all_read()
    {
        if (Auth::check()) {
            Auth::user()->unreadNotifications->markAsRead();
        }
        return redirect()->back();
    }

    // user notification
    public function notifications()
    {
        $notifications = Auth::user()->notifications()->latest()->get();
        return view('Home.home_notification', compact('notifications'));
    }

    // Admin: mark single notification as read
    public function mark_as_read($id)
    {
        $notification = Auth::user()->notifications()->find($id);

        if (!$notification) {
            return redirect()->back()->with('error', 'Notification not found.');
        }

        // Mark as read
        $notification->markAsRead();

        // If admin, redirect to order notification page
        if (Auth::user()->usertype === 'admin' && isset($notification->data['order_id'])) {
            return redirect()->route('admin_notification', [
                'orderId' => $notification->data['order_id']
            ]);
        }

        // Default redirection for non-admins
        return redirect()->back();
    }

    // Admin: view notifications for specific order
    public function admin_notification($orderId)
    {
        $user = Auth::user();

        if (!$user || $user->usertype !== 'admin') {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // Fetch the order
        $order = Order::with('user')->findOrFail($orderId);

        // Unread notifications for this order
        $unread = $user->unreadNotifications()
            ->where('data->order_id', $orderId)
            ->get();

        // Read notifications for this order
        $read = $user->readNotifications()
            ->where('data->order_id', $orderId)
            ->get();

        return view('Admin.notification', compact('order', 'unread', 'read'));
    }
}
