<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::match(['get','post'],'/admin', 'AdminController@login'); //submit our form for login process

Auth::routes();
//Home Page Route
Route::get('/home', 'HomeController@index')->name('home');

//Index page
Route::get('/','IndexController@index');

//Contact Us page Route
Route::get('/contact-us','IndexController@contactUs');

//Category listing page  
Route::get('/products/{url}','ProductsController@products');

//Product Detail Page
Route::get('product/{id}','ProductsController@product');

//Cart Page Route
Route::match(['get','post'],'/cart', 'ProductsController@cart');

//Add to cart Route
Route::match(['get','post'],'/add-cart', 'ProductsController@addtocart');

//Delete Cart items Route
Route::get('cart/delete-product/{id}','ProductsController@deleteCartProduct');

//Update product quantity in cart
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

//Get product Attribute Price
Route::get('/get-product-price','ProductsController@getProductPrize');

//Apply Coupon Code
Route::post('/cart/apply-coupon','ProductsController@ApplyCoupon');

// User Login/Register Route
Route::get('/login-register','UsersController@userLoginRegister');
// User register form submit
Route::post('/user-register','UsersController@register');
//USer Login Route
Route::post('/user-login','UsersController@login');
//User LogOut Route
Route::get('user-logout','UsersController@logout');

//All Routes after login
Route::group(['middleware' => ['frontlogin']],function(){
//User account Page
Route::match(['get','post'],'account','UsersController@account');
//check user current pwd route
Route::post('/check-user-pwd','UsersController@chkUserPassword');
//update user password
Route::post('/update-user-pwd','UsersController@updatePassword');
//checkout page
Route::match(['get','post'],'checkout','ProductsController@checkout');
//Order Review Page
Route::match(['get','post'],'order-review','ProductsController@orderReview');
//Place Order
Route::match(['get','post'],'place-order','ProductsController@placeOrder');
//COD Thanks Page
Route::get('/thanks','ProductsController@thanks');
//Stripe  Page
Route::get('/paypal','ProductsController@paypal');
//User Orders Page
Route::get('/orders','ProductsController@userOrders');
//User Ordered Products Page
Route::get('/orders/{id}','ProductsController@userOrderDetails');
});

//Check if user is already exists
Route::match(['GET','POST'],'/check-email','UsersController@checkEmail');

Route::group(['middleware' => ['auth']],function(){
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/settings', 'AdminController@settings');
Route::get('/admin/check-pwd', 'AdminController@chkpassword');
Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

// Categories Routes (Admin)
Route::match(['get','post'],'/admin/add-category', 'CategoryController@addCategory');
Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
Route::get('/admin/view-categories', 'CategoryController@viewCategories');

//Products Routes (Admin)
Route::match(['get','post'],'/admin/add-product', 'ProductsController@addProduct');
Route::match(['get','post'],'/admin/edit-product/{id}', 'ProductsController@editProduct');
Route::get('/admin/view-products','ProductsController@viewProducts');
Route::get('/admin/delete-product/{id}', 'ProductsController@deleteProduct');
Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteAltImage');

//products attributes routes (Admin)
Route::match(['get','post'],'/admin/add-attributes/{id}', 'ProductsController@addAttributes');
Route::match(['get','post'],'/admin/edit-attributes/{id}', 'ProductsController@editAttributes');
Route::match(['get','post'],'/admin/add-images/{id}', 'ProductsController@addImages');
Route::get('/admin/delete-attribute/{id}', 'ProductsController@deleteAttribute');

//Coupons Route
Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
Route::get('/admin/view-coupons', 'CouponsController@viewCoupons');
Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');

//Admin Orders Route
Route::get('/admin/view-orders', 'ProductsController@viewOrders');

//Admin Order Detail Page
Route::get('/admin/view-order/{id}', 'ProductsController@viewOrderDetails');

//Update Order Status
Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');
});

Route::get('/logout', 'AdminController@logout');