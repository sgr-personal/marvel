<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
Route::get('clear-cache', function() {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');

    return redirect()->route('home')->with('suc', 'Cache Cleared!');
});

Route::get('/ekart', 'Controller@ekart');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', 'HomeController@login_page')->name('login');

Route::post('/login', 'HomeController@login');

Route::post('/register', 'HomeController@register')->name('register');

Route::get('/already-registered', 'HomeController@already_registered')->name('already-registered');

Route::get('/forgot-password', 'HomeController@forgot_password')->name('forgot-password');

Route::post('/coupon/apply', 'CartController@coupon_apply')->name('coupon-apply');

Route::get('/coupon/remove', 'CartController@coupon_remove')->name('coupon-remove');

Route::get('/page/faq/', 'HomeController@faq')->name('faq');

Route::get('/contact', 'HomeController@contact_page')->name('contact');

Route::get('/custom-made', 'HomeController@customMade')->name('custom-made');

Route::post('/custom-made-query', 'HomeController@customMadeQuery');

Route::get('/quotation/{id}', 'HomeController@quotationPdf');

Route::post('/contact', 'MailController@sendEmail');

Route::get('/page/{slug}', 'HomeController@page')->name('page');

Route::get('/shop', 'HomeController@shop')->name('shop');

Route::get('/search/{s?}', 'HomeController@shop')->name('search');

Route::get('/category/{slug}', 'HomeController@category')->name('category');

Route::get('/category/{categorySlug}/{subCategorySlug}/{offset?}', 'HomeController@sub_category')->name('sub-category');

Route::get('/product/{slug}', 'HomeController@product')->name('product-single');

Route::get('cities', 'HomeController@city')->name('cities');

Route::get('city/{city_id}', 'HomeController@area')->name('area');

Route::get('refer/{code}', 'HomeController@refer')->name('refer');

Route::post('newsletter', 'HomeController@newsletter')->name('newsletter');

/** If User's Logged In */

Route::get('/logout', 'UserController@logout')->name('logout');

Route::get('/cart', 'CartController@index')->name('cart');

Route::get('/cart/empty', 'CartController@empty')->name('cart-empty');

Route::post('/cart/add', 'CartController@add')->name('cart-add');

Route::get('/cart/single/add', 'CartController@add');

Route::get('/cart/add/{id}/{varient_id}', 'CartController@add_single')->name('cart-add-single');

Route::post('/cart/single/add', 'CartController@add_single_varient')->name('cart-add-single-varient');

Route::post('/cart/update/{id}', 'CartController@update')->name('cart-update');

Route::get('/cart/remove/{id}', 'CartController@remove')->name('cart-remove');

Route::get('/checkout/summary', 'CheckoutController@index')->name('checkout');

Route::get('/checkout/address', 'CheckoutController@address')->name('checkout-address');

Route::post('/checkout/address', 'CheckoutController@address');

Route::get('/checkout/payment', 'CheckoutController@payment')->name('checkout-payment');

Route::post('/checkout/proceed', 'CheckoutController@proceed')->name('checkout-proceed');

Route::get('/checkout/razorpay', 'CartController@checkout_razorpay_init')->name('checkout-razorpay-init');

Route::post('/checkout/razorpay', 'CartController@checkout_razorpay')->name('checkout-razorpay');

Route::get('/checkout/paypal', 'CartController@checkout_paypal_init')->name('checkout-paypal-init');

Route::get('/checkout/paypal/{type}', 'CartController@checkout_paypal')->name('checkout-paypal');

Route::get('/checkout/payu', 'CartController@checkout_payu_init')->name('checkout-payu-init');

Route::post('/checkout/payu', 'CartController@checkout_payu')->name('checkout-payu');

Route::get('/checkout/payu-bolt', 'CartController@checkout_payu_bolt_init')->name('checkout-payu-init-bolt');

Route::post('/checkout/payu-bolt', 'CartController@checkout_payu_bolt')->name('checkout-payu-bolt');

Route::get('/favorites', 'FavouriteController@index')->name('favourite');

Route::get('/favourite/remove/{id}', 'FavouriteController@remove')->name('favourite-remove');

Route::post('/favourite-post/add', 'FavouriteController@add_ajax');

Route::post('/favourite-post/remove', 'FavouriteController@remove_ajax');

Route::get('/my-account', 'UserController@index')->name('my-account')->middleware('loggedin');

Route::post('/my-account', 'UserController@update_profile');

Route::get('/orders/{type?}', 'UserController@orders')->name('my-orders');

Route::get('/orders/status/{orderId}/{orderItemId}/{status}', 'UserController@order_status_update')->name('order-item-status');

Route::get('/orders/track/{orderId}', 'UserController@track')->name('order-track-item');

Route::get('/change-password', 'UserController@password')->name('change-password');

Route::post('/change-password', 'UserController@change_password');

Route::post('/reset-password', 'UserController@reset_password')->name('reset-password');

Route::get('/wallet-history','UserController@walletHistory')->name('wallet-history');

Route::get('/transaction-history','UserController@transactionHistory')->name('transaction-history');

Route::get('/notification','UserController@notification')->name('notification');

Route::get('/refer-earn','UserController@referearn')->name('refer-earn');

Route::get('/addresses', 'UserController@address')->name('addresses');

Route::post('/address/add', 'UserController@address_add')->name('address-add');

Route::get('/address/remove/{id}', 'UserController@address_remove')->name('address-remove');

/** Stripe Payment Gateway */
Route::get('/payment/stripe', 'Payments\StripeController@index')->name('payment-stripe-start');

Route::get('/payment/stripe/{type}/{orderId?}', 'Payments\StripeController@complete')->name('payment-stripe-complete');
/** Stripe Payment Gateway End */

/** Midtrans Payment Gateway */
Route::get('/payment/midtrans', 'Payments\MidtransController@index')->name('payment-midtrans-start');

Route::get('/payment/midtrans/{type}/{orderId?}', 'Payments\MidtransController@complete')->name('payment-midtrans-complete');
/** Midtrans Payment Gateway End */

/** Flutterwave Payment Gateway */
Route::get('/payment/flutterwave', 'Payments\FlutterwaveController@index')->name('payment-flutterwave-start');

Route::get('/payment/flutterwave/{type}', 'Payments\FlutterwaveController@complete')->name('payment-flutterwave-complete');
/** Flutterwave Payment Gateway End */

/** Paystack Payment Gateway */
Route::get('/payment/paystack', 'Payments\PaystackController@index')->name('payment-paystack-start');

Route::get('/payment/paystack/{type}', 'Payments\PaystackController@complete')->name('payment-paystack-complete');
/** Paystack Payment Gateway End */

/** PayTm Payment Gateway */
Route::get('txnTest', 'CartController@txnTest')->name('txnTest');
Route::post('pgRedirect', 'CartController@pgRedirect')->name('pgRedirect');
Route::post('paytm/success', 'CartController@pgResponse')->name('success');
/** PayTm Payment Gateway End */

//Auth::routes();

Route::get('google/redirect', 'SocialController@redirect');

Route::get('google/callback', 'SocialController@callback');

