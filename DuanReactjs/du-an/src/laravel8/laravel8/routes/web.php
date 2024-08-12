<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
// 
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OnePageController;
// 
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\MailController;


Route::group([
    // chỉ vao folder frontend
    'namespace' => 'Frontend'
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/page/{slug}',[App\Http\Controllers\Frontend\OnePageController::class, 'show'])->name('frontend.onepage.show');
    Route::get('/detail-product/{id}',[HomeController::class, 'detailProduct'])->name('detail product');
    Route::post('/detail-product/{id}',[HomeController::class, 'addReview']);
    Route::post('ajaxRating', [App\Http\Controllers\Frontend\ProductController::class, 'ajaxRating']);
    Route::get('/search', [HomeController::class, 'SearchProduct']);
    Route::get('/ajaxPriceRange', [HomeController::class, 'SearchProductByPrice']);
    Route::get('/ajaxAddToCart', [CartController::class, 'addToCart']);
    Route::get('/yourCart', [CartController::class, 'showCart']);
    Route::get('/cart-qty-delete/{id}', [CartController::class, 'cartDelete']);
    Route::post('/yourCart', [MailController::class, 'sendMail']);

    
     //blog
    Route::get('/blog/list',[App\Http\Controllers\Frontend\BlogController::class, 'list']);
    Route::get('/blog/single/{id}',[App\Http\Controllers\Frontend\BlogController::class, 'single']);

    Route::get('/product/brand/{id}',[App\Http\Controllers\Frontend\ProductController::class, 'productBrand']);

    Route::get('/product/category/{id}',[App\Http\Controllers\Frontend\ProductController::class, 'productCategory']);

    // check not login for form login
   Route::group(['middleware' => 'memberNotLogin'], function () {

        Route::get('/member-login', [MemberController::class, 'showLogin'])->name('memberLogin');
        Route::post('/member-login', [MemberController::class, 'login']);

        Route::get('/member-register', [MemberController::class, 'showRegister']);
        Route::post('/member-register', [MemberController::class, 'register']);
   });


    // check login 
    Route::group(['middleware' => 'member'], function () {

        //product
        Route::get('/product/add',[App\Http\Controllers\Frontend\ProductController::class, 'product']);
        Route::post('/product/add',[App\Http\Controllers\Frontend\ProductController::class, 'addProduct']);
        Route::get('/product/{id}/list',[App\Http\Controllers\Frontend\ProductController::class, 'listProduct']);
        Route::get('/product/view/{id}',[App\Http\Controllers\Frontend\ProductController::class, 'viewProduct']);
        Route::post('/product/view/{id}',[App\Http\Controllers\Frontend\ProductController::class, 'updateProduct']);
        Route::get('/product/delete/{id}',[App\Http\Controllers\Frontend\ProductController::class, 'deleteProduct']);

        //member
        Route::get('/member-profile', [MemberController::class, 'show']);
        Route::post('/member-profile', [MemberController::class, 'update']);
        Route::get('/member-logout',[MemberController::class, 'logout']);

        // blog
        Route::post('/blog/single/{id}',[App\Http\Controllers\Frontend\BlogController::class, 'comment']);
        Route::post('/blog/ajaxRequest',[App\Http\Controllers\Frontend\BlogController::class, 'ajaxRequest']); 

    });
});


// admin (backend)

Auth::routes();

//Login manager Route
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Auth'
], function () {
    Route::get('/',[LoginController::class, 'showLoginForm']);
    Route::get('/login',[LoginController::class, 'showLoginForm']);
    Route::post('/login',[LoginController::class, 'login']);
    Route::get('/logout',[LoginController::class, 'logout']);
});

Route::group([
    'prefix' => 'admin', //add "admin" before link
    'namespace' => 'Admin',
    'middleware' => ['admin']
], function () {

    Route::get('/dashboard',[DashboardController::class, 'index']);
// 
    Route::get('/user/profile/{id}',[UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('/user/profile/{id}',[UserController::class, 'update'])->name('admin.user.update');
    Route::get('/user/list',[UserController::class, 'index'])->name('admin.user.index');
// user
    Route::get('/page',[OnePageController::class, 'list'])->name('admin.onepage.list');
    Route::get('/page/add',[OnePageController::class, 'create'])->name('admin.onepage.create');
    Route::post('/page/add',[OnePageController::class, 'store'])->name('admin.onepage.store');
    Route::get('/page/edit/{id}',[OnePageController::class, 'edit'])->name('admin.onepage.edit');
    Route::post('/page/edit/{id}',[OnePageController::class, 'update'])->name('admin.onepage.update');

// //category
    Route::get('/category/add',[CategoryController::class, 'Category'])->name('category');
    Route::post('/category/add',[CategoryController::class, 'addCategory']);
    Route::get('/delete-category/{id}',[CategoryController::class, 'deleteCategory']);
   
// //brand
    Route::get('/brand/add',[BrandController::class, 'listBrand'])->name('brand');
    Route::post('/brand/add',[BrandController::class, 'addBrand'])->name('addbrand');
    Route::get('/delete-brand/{id}',[BrandController::class, 'deleteBrand'])->name('deletebrand');
    
// product
    Route::get('/product/list',[ProductController::class, 'listProduct'])->name('listProduct');
    Route::get('/product/view/{id}',[ProductController::class, 'viewProduct'])->name('viewProduct');
    Route::post('/product/view/{id}',[ProductController::class, 'activeProduct'])->name('activeProduct');
    Route::get('/product/delete/{id}',[ProductController::class, 'deleteProduct'])->name('deleteProduct');

// Blog
    Route::get('/blog',[App\Http\Controllers\Admin\BlogController::class, 'list']);
    Route::get('/blog/add',[App\Http\Controllers\Admin\BlogController::class, 'create']);
    Route::post('/blog/add',[App\Http\Controllers\Admin\BlogController::class, 'create_success']);

    Route::get('/blog/edit/{id}',[App\Http\Controllers\Admin\BlogController::class, 'edit']);
    Route::post('/blog/edit/{id}',[App\Http\Controllers\Admin\BlogController::class, 'update']);
    Route::get('/blog/delete/{id}',[App\Http\Controllers\Admin\BlogController::class, 'delete']);

//Country
    Route::get('/country',[CountryController::class, 'country']);
    Route::post('/country',[CountryController::class, 'addCountry']);
    Route::get('/country/delete/{id}',[CountryController::class, 'deleteCountry']);

});