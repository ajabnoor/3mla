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
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('home');
});

Route::get('/migrate', function (Request $request) {
    if ($request->password == 'waleed'){
        echo $exitCode = Artisan::call('migrate', ['--force' => true]);
    return 'true';
    }
    return 'false';
});
Route::get('/seed', function (Request $request) {
    if ($request->password == 'waleed'){
        echo $exitCode = Artisan::call('db:seed', ['--force' => true]);
        return 'true';
    }
    return 'false';
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

// Route::get('dashboard', 'HomeController@index');

Route::redirect('dashboard','home');
Route::name('admin.')->middleware('role:admin')->prefix('admin')->namespace('Admin')->group(function () {
    
    Route::get('/', 'OrderController@index')->name('home');
    
    Route::resource('order', 'OrderController');
    Route::resource('currency', 'CurrencyController');
    Route::resource('pricecurrency', 'PriceCurrencyController');
    Route::resource('country', 'CountryController');
    Route::resource('city', 'CityController');
    Route::resource('user', 'UserController');
    Route::resource('product', 'ProductController');
    Route::resource('status', 'StatusController');
    Route::resource('badge', 'BadgeController');

    Route::get('order/loginasowner/{user_id}/{order_id}','OrderController@loginAsOwner')->name('loginasowner');
    Route::get('order/loginasbuyer/{user_id}/{order_id}','OrderController@loginAsBuyer')->name('loginasbuyer');
    Route::get('product/publish/{product_id}','ProductController@publish')->name('publish');
    Route::get('user/addbadge/{user_id}/{badge_id}','UserController@addBadge')->name('addbadge');
    Route::get('user/removebadge/{user_id}/{badge_id}','UserController@removeBadge')->name('removebadge');
});

Route::name('user.')->middleware('auth')->prefix('user')->namespace('User')->group(function () {

    Route::resource('myorders', 'MyOrderController');
    Route::resource('mysales', 'MySaleController');
    Route::resource('mycustomers', 'MyCustomerController');
    Route::get('neworder/{product_id}', 'MyOrderController@newOrder');

});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('getCities/{country}', 'Admin\ProductController@getCities');


////////AXIOS ROUTES/////////

//Home routes
Route::any('getProducts/{page?}', 'HomeController@getProducts');
Route::get('getFilters', 'HomeController@getFilters');


//Chat routes
Route::get('getmessages/{product_id}/{newOrder}','ChatController@getMessages');
Route::get('getordermessages/{order_id}','ChatController@getOrderMessages');
Route::post('message', 'ChatController@postMessage')->middleware('auth');

//Notifications routes
// Route::get('clearnotifications/{order_id}','MyOrderController@clearNotifications');

//Amount routes
Route::post('addamount', 'User\MyOrderController@addAmount')->middleware('auth');
Route::get('getamount/{order_id}', 'User\MyOrderController@getAmount')->middleware('auth');

//Status routes
Route::get('getstatus/{order_id}','User\MyStatusController@getCurrentStatus')->middleware('auth');
Route::get('updatestatus/{order_id}/{status_id}','User\MyStatusController@updateStatus')->middleware('auth');

//Crypto prices 
Route::get('getcurrency/{id}', 'Admin\ProductController@getCurrency');
Route::get('getpricecurrency/{id}', 'Admin\ProductController@getPriceCurrency');
Route::get('getcryptoprice/{id}', 'Admin\ProductController@getCryptoPrice');