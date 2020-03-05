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
/*======================================FRONT ROUTE============================================================*/
Auth::routes([
    'register'=> false,
    'login'=> false,
    'reset' => false, 
    'verify' => false,
]);
//start project
Route::get('/home','HomeController@getData')->name('home');
//log-in
Route::view('/login','login')->name('login');
Route::post('/login-submit','Auth\LoginController@authenticate')->name('login-submit');
//log-up
Route::view('/register','register')->name('register');
Route::post('/register-submit','Auth\RegisterController@create')->name('register-submit');

//blog
Route::view('/blog','blog')->name('blog');
//contact
Route::view('/contact','contact')->name('contact');
//blog-detail
Route::view('/blog-detail','blog-detail')->name('blog-detail');
//shopping-cart
Route::get('/view-cart-detail','CartController@getAllItemInCart')->name('view-cart-detail');
Route::get('/add-to-cart/{product_id}','CartController@addToCart')->name('add-to-cart');
Route::get('/delete-item-cart/{product_id}','CartController@deleteItem')->name('delete-item-cart');
//checkout
Route::view('/checkout','checkout')->name('checkout');
//shop
Route::get('/shop','ShopController@getAllProduct')->name('shop');

/*=======================================ADMIN ROUTE============================================================================*/
//admin
Route::view('/admin','admin')->name('admin');
//category
Route::group(['prefix'=>'admin-category'],function(){
    Route::get('/','AdminCategoryController@getAllCategory')->name('admin-category');
    Route::get('/add','AdminCategoryController@addCategory')->name('add-category');
    Route::get('/add-submit','AdminCategoryController@insertCategory')->name('add-category-submit');
    Route::get('/edit/{category_id}','AdminCategoryController@editCategory')->name('edit-category');
    Route::get('/edit-submit/{category_id}','AdminCategoryController@updateCategory')->name('edit-category-submit');
    Route::get('/delete/{category_id}','AdminCategoryController@deleteCategory')->name('delete-category');
});

//product
Route::group(['prefix'=>'admin-product'],function(){
    Route::get('/','AdminProductController@getAllProduct')->name('admin-product');
    Route::get('/add','AdminProductController@addProduct')->name('add-product');
    Route::get('/add-submit','AdminProductController@insertProduct')->name('add-product-submit');
    Route::get('/edit/{product_id}','AdminProductController@editProduct')->name('edit-product');
    Route::get('/edit-submit/{product_id}','AdminProductController@updateProduct')->name('edit-product-submit');
    Route::get('/delete/{product_id}','AdminProductController@deleteProduct')->name('delete-product');
});



//order 
Route::view('/admin-order','admin-order')->name('admin-order');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
