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

// frontend
Route::group([
    'namespace' => 'Frontend'
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/page/{slug}','OnePageController@show')->name('frontend.onepage.show');
    
    //blog
    Route::get('/blog/list','BlogController@list');

    Route::get('/blog/single/{id}','BlogController@single');

    



    // check not login for form login
    Route::group([
    	'middleware' => 'memberNotLogin'
	], function () {
        Route::get('/member-login', 'MemberController@showLogin');
        Route::post('/member-login', 'MemberController@login');

        Route::get('/member-register', 'MemberController@showRegister');
        Route::post('/member-register', 'MemberController@register');
    });

    // check login 
    Route::group(['middleware' => 'member'], function () {
        Route::get('/member-profile', 'MemberController@show');
        Route::get('/member-logout','MemberController@logout');

        Route::post('/blog/single/{id}','BlogController@comment');
        
    //rate star
        Route::post('/blog/ajaxRequest','BlogController@ajaxRequest');
    //product
        Route::get('/product', 'ProductController@list');
        Route::get('/product/add', 'ProductController@add');
        Route::post('/product/add','ProductController@addSuccess');
        Route::get('/product/delete/{id}','ProductController@delete');

        Route::get('/product/view/{id}','ProductController@view');
        Route::post('/product/view/{id}','ProductController@edit');
    });
});


// admin
Auth::routes();
//Login manager Route
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Auth'
], function () {
    Route::get('/', 'LoginController@showLoginForm');
    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['admin']
], function () {
	Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');

    Route::get('/user/profile/{id}','UserController@edit')->name('admin.user.edit');
    Route::post('/user/profile/{id}','UserController@update')->name('admin.user.update');
    Route::get('/user/list','UserController@index')->name('admin.user.index');
    Route::get('/user/delete/{id}','UserController@delete');

    Route::get('/page','OnePageController@list')->name('admin.onepage.list');
    Route::get('/page/add','OnePageController@create')->name('admin.onepage.create');
    Route::post('/page/add','OnePageController@store')->name('admin.onepage.store');
    Route::get('/page/edit/{id}','OnePageController@edit')->name('admin.onepage.edit');
    Route::post('/page/edit/{id}','OnePageController@update')->name('admin.onepage.update');
//Country
    Route::get('/country','CountryController@country');
    Route::post('/country','CountryController@addCountry');
    Route::get('/country/delete/{id}','CountryController@deleteCountry');

//Contact
    Route::get('/contact','ContactController@list');
    Route::get('/contact/add','ContactController@create');
    Route::post('/contact/add','ContactController@store');
    Route::get('/contact/edit/{id}','ContactController@edit');
    Route::post('/contact/edit/{id}','ContactController@update');
    Route::get('/contact/delete/{id}','ContactController@delete');

//Blog
    Route::get('/blog','BlogController@list');
    Route::get('/blog/add','BlogController@create');
    Route::post('/blog/add','BlogController@create_success');
    Route::get('/blog/edit/{id}','BlogController@edit');
    Route::post('/blog/edit/{id}','BlogController@update');
    Route::get('/blog/delete/{id}','BlogController@delete');
//Brand
    Route::get('/brand','BrandController@brand');
    Route::post('/brand','BrandController@addBrand');
    Route::get('/brand/delete/{id}','BrandController@deleteBrand');
//Category
    Route::get('/category','CategoryController@list');
    Route::post('/category','CategoryController@add');
    Route::get('/category/delete/{id}','CategoryController@delete');
});

