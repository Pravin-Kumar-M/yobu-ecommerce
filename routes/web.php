<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Flasher\Prime\Notification\Notification;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/dashboard', [HomeController::class, 'user_dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// Home Controller route
Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

// view category route
Route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth', 'admin']);

// add category route
Route::post('add_category', [AdminController::class, 'add_category'])->middleware(['auth', 'admin']);

// delete category route
Route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->middleware(['auth', 'admin']);

// edit category route
Route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->middleware(['auth', 'admin']);

// update category route
Route::post('update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth', 'admin']);

// add product route
Route::get('add_product', [AdminController::class, 'add_product'])->middleware(['auth', 'admin']);

// upload product route
Route::post('upload_product', [AdminController::class, 'upload_product'])->middleware(['auth', 'admin']);

// view product route
Route::get('view_product', [AdminController::class, 'view_product'])->middleware(['auth', 'admin']);

// delete product route
Route::get('delete_product/{id}', [AdminController::class, 'delete_product'])->middleware(['auth', 'admin']);

// update product route
Route::get('update_product/{slug}', [AdminController::class, 'update_product'])->middleware(['auth', 'admin']);

// edit product route
Route::post('edit_product/{id}', [AdminController::class, 'edit_product'])->middleware(['auth', 'admin']);

// product search route
Route::get('product_search', [AdminController::class, 'product_search'])->middleware(['auth', 'admin']);

// on the way
Route::get('on_the_way/{id}', [AdminController::class, 'on_the_way'])->middleware(['auth', 'admin']);

// delivered
Route::get('delivered/{id}', [AdminController::class, 'delivered'])->middleware(['auth', 'admin']);

// view_order
Route::get('order_page', [AdminController::class, 'order_page'])->middleware(['auth', 'admin'])->name('order_page');

// reports
Route::post('/admin/reports/fetch', [AdminController::class, 'fetch'])->name('admin.fetch');

// charts 
Route::get('charts_page', [AdminController::class, 'charts_page'])->middleware(['auth', 'admin']);

// forms
Route::get('forms_page', [AdminController::class, 'forms_page'])->middleware(['auth', 'admin']);





// << ----------------------------- Home Controller ---------------------------- >>




// product details route
Route::get('product_details/{slug}', [HomeController::class, 'product_details'])->name('product_details');

// products shop page route
Route::get('shop', [HomeController::class, 'shop_page'])->name('products');

// about page route
Route::get('about', [HomeController::class, 'about'])->name('about');

// blog page route
Route::get('blog', [HomeController::class, 'blog'])->name('blog');

// blog details page route
Route::get('blog_detail', [HomeController::class, 'blog_detail'])->name('blog_detail');

// contact page route
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

// wishlist page route
Route::get('view_wishlist', [HomeController::class, 'view_wishlist'])->name('view_wishlist');

// add to wishlist
Route::post('add_to_wishlist', [HomeController::class, 'add_to_wishlist'])->name('add_to_wishlist');

// delete wishlist
Route::delete('wishlist/delete/{id}', [HomeController::class, 'deleteWishlist'])->name('wishlist.delete');

// google signin
Route::controller(HomeController::class)->group(function () {

    Route::get('auth/google', 'googleLogin')->name('auth.google');
    Route::get('auth/google_callback', 'googleAuth')->name('auth.google_callback');
});


// display categories

Route::get('shop', [HomeController::class, 'shopPage'])->name('shop.page');

// FAQ's
Route::get('faq', [HomeController::class, 'faq'])->name('faq');




// << ----------------------------- Profile Controller ---------------------------- >>




// user-profile
Route::get('user-profile', [ProfileController::class, 'user_profile'])->name('user_profile');

// privacy policy
Route::get('privacy-policy', [ProfileController::class, 'privacy_policy'])->name('privacy_policy');

// payment methods
Route::get('payment-methods', [ProfileController::class, 'payment_methods'])->name('payment_methods');

// gift
Route::get('gift', [ProfileController::class, 'gift'])->name('gift');






// << ----------------------------- Payment Controller ---------------------------- >>




// stripe payment route
Route::prefix('stripe_payment')->group(function () {
    Route::post('stripe', [PaymentController::class, 'stripe'])->name('stripe');
    Route::get('success', [PaymentController::class, 'success'])->name('stripe.success');
    Route::get('cancel', [PaymentController::class, 'cancel'])->name('stripe.cancel');
});

// paypal payment
Route::prefix('paypal_payment')->group(function () {
    Route::post('paypal', [PaymentController::class, 'paypal'])->name('paypal');
    Route::get('success', [PaymentController::class, 'success'])->name('paypal.paypal_success');
    Route::get('cancel', [PaymentController::class, 'cancel'])->name('paypal.paypal_cancel');
});





// << ----------------------------- Product Controller ---------------------------- >>



// add to cart route
Route::get('add_cart/{id}', [ProductController::class, 'add_cart'])->middleware(['auth', 'verified']);

Route::post('add_cart/{id}', [ProductController::class, 'add_cart'])->name('add_cart')->middleware(['auth', 'verified']); // Product details cart

// shopping cart route
Route::get('view_cart', [ProductController::class, 'view_cart'])->name('view_cart')->middleware(['auth', 'verified']);

// update cart quantity route
Route::post('update_cart', [ProductController::class, 'update_cart'])->middleware(['auth', 'verified']);

// delete cart item route
Route::get('delete_cart/{id}', [ProductController::class, 'delete_cart'])->middleware(['auth', 'verified']);

// checkout page route
Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout')->middleware(['auth', 'verified']);

// confirm order route
Route::post('confirm_order', [ProductController::class, 'confirmOrder'])->name('confirm_order')->middleware(['auth', 'verified']);




// << ----------------------------- Notification Controller ---------------------------- >>


// mark all notification read route
Route::get('mark-all-as-read', [NotificationController::class, 'mark_all_read'])->name('mark_all_read');

// user notification route
Route::get('notifications', [NotificationController::class, 'notifications'])->name('notifications');

// admin notification route
Route::get('admin/notification/{orderId}', [NotificationController::class, 'admin_notification'])->name('admin_notification');
Route::get('mark-as-read/{id}', [NotificationController::class, 'mark_as_read'])->name('mark_as_read');



// << ----------------------------- Chat Message Controller ---------------------------- >>

// user
Route::middleware('auth')->group(function () {
    Route::get('/chat/messages', [App\Http\Controllers\ChatController::class, 'index']);
    Route::post('/chat/messages', [App\Http\Controllers\ChatController::class, 'store']);
});

// admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/chats', [ChatController::class, 'page'])->name('admin.chats');

    // Data APIs
    Route::get('/admin/chat/threads', [ChatController::class, 'threads']);         // list users + counts
    Route::get('/admin/chat/{user}', [ChatController::class, 'messages']);         // messages with a user
    Route::post('/admin/chat/{user}', [ChatController::class, 'send']);            // admin sends message
    Route::post('/admin/chat/{user}/read', [ChatController::class, 'markRead']);   // mark user's msgs as read
    Route::get('/admin/chat/unread-count', [ChatController::class, 'unreadCount']); // badge polling
});
