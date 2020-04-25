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

/*======================================FRONT ROUTE============================================================*/
// Auth::routes([
//     'register'=> false,
//     'reset' => false,
//     'login' => false,
//     'verify' => true,
// ]);
Auth::routes(['verify' => true]);
//start project
Route::get('/','HomeController@getData')->name('home');

//log-in
Route::view('/login','auth.login')->name('login');
Route::post('/login-submit','Auth\LoginController@authenticate')->name('login-submit');
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/reset-password','Auth\ResetPasswordController@resetPassword')->name('reset-password');
//log-up
Route::view('/register','auth.register')->name('register');
Route::post('/register-submit','Auth\RegisterController@create')->name('register-submit');

//blog
Route::view('/blog','blog')->name('blog');
//contact
Route::view('/contact','contact')->name('contact')->middleware('auth');
//blog-detail
Route::view('/blog-detail','blog-detail')->name('blog-detail');
//shopping-cart
Route::get('/view-cart-detail','CartController@getViewCart')->name('view-cart-detail');
Route::get('/add-to-cart/{product_id}','CartController@addToCart')->name('add-to-cart');
Route::get('/delete-item-cart/{product_id}','CartController@deleteItem')->name('delete-item-cart');
Route::get('/update-cart/listItemsId={listItemsId}&listQuanlity={listQuanlity}','CartController@updateCart')->name('update-cart');
//checkout
Route::get('/checkout','CheckoutController@getViewCheckout')->name('checkout');
Route::post('/checkout-submit','CheckoutController@formCheckoutSubmit')->name('checkout-submit');
//shop
Route::get('/shop','ShopController@getAllProduct')->name('shop');
Route::get('/add-favorite-item/{product_id}/{product_name}/{product_price}','ShopController@addFavoriteItemList')->name('add-favorite-items');
//product
Route::get('/product-detail/{product_id}','ProductController@getViewDetail')->name('product-detail');
//profile
Route::get('/profile/{username}','UserController@getView')->name('profile');
Route::post('/update-profile/{username}','UserController@updateUserInfo')->name('update-user');
/*=======================================ADMIN ROUTE============================================================================*/
//admin
Route::view('/admin','admin')->name('admin')->middleware('checkrole');
//category
Route::group(['prefix'=>'admin-category','middleware'=>'isrole'],function(){
    Route::get('/','AdminCategoryController@getAllCategory')->name('admin-category');
    Route::get('/add','AdminCategoryController@addCategory')->name('add-category');
    Route::post('/add-submit','AdminCategoryController@insertCategory')->name('add-category-submit');
    Route::get('/edit/{category_id}','AdminCategoryController@editCategory')->name('edit-category');
    Route::get('/edit-submit/{category_id}','AdminCategoryController@updateCategory')->name('edit-category-submit');
    Route::get('/delete/{category_id}','AdminCategoryController@deleteCategory')->name('delete-category');
});

//product
Route::group(['prefix'=>'admin-product','middleware'=>'isrole'],function(){
    Route::get('/','AdminProductController@getAllProduct')->name('admin-product');
    Route::get('/add','AdminProductController@addProduct')->name('add-product');
    Route::post('/add-submit','AdminProductController@insertProduct')->name('add-product-submit');
    Route::get('/edit/{product_id}','AdminProductController@editProduct')->name('edit-product');
    Route::post('/edit-submit/{product_id}','AdminProductController@updateProduct')->name('edit-product-submit');
    Route::get('/delete/{product_id}','AdminProductController@deleteProduct')->name('delete-product');
});

//order 
Route::group(['prefix'=>'admin-order','middleware'=>'isrole'],function(){
    Route::get('/','AdminOrderController@getView')->name('admin-order');
    Route::get('/add-order','AdminOrderController@addOrder')->name('add-order');
    Route::get('/get-product/c_id={category_id}','AdminOrderController@getProductByCategoryId');
    Route::get('/add-order-submit','AdminOrderController@insertOrder')->name('add-order-submit');
    Route::get('/delete/{order_id}','AdminOrderController@deleteOrder')->name('delete-order');
    Route::get('/detail-order/{order_id}/{popup}','AdminOrderController@getViewDetail')->name('detail-order');
    Route::post('/edit-detail-submit/{order_id}','AdminOrderController@editOrderDetailSubmit')->name('submit-edit-order-detail');
    Route::get('/delete-order-item/{order_id}/{order_item_id}','AdminOrderController@deleteOrderItem')->name('delete-order-item');
    Route::get('/update-order-item/order_id={order_id}&listItemsId={listItemsId}&listQuanlity={listQuanlity}','AdminOrderController@updateOrderItem')->name('update-order-item');

});
//ajax
Route::group(['prefix'=>'ajax','middleware'=>'isrole'],function(){
Route::get('/get-product/c_id={category_id}','AjaxController@getProductByCategoryId')->name('get-product-ajax');
Route::get('/add-product/p_id={product_id}','AjaxController@addProductIntoOrder')->name('add-product-ajax');
Route::get('/delete-product/p_id={product_id}','AjaxController@deleteProductIntoOrder')->name('delete-product-ajax');
Route::get('/get-category/c_id={category_id}','AjaxController@getCategory')->name('get-category-ajax');
});
Route::get('/home', 'HomeController@index')->name('home');
