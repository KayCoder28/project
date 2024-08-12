<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'namespace' => 'Api'
], function () {

    // member
    Route::post('/login',[MemberController::class, 'login']);
    Route::post('/register',[MemberController::class, 'register']);

    // product
    Route::get('/product',[ProductController::class, 'productHome']);
    Route::get('/product/list',[ProductController::class, 'productList']);
   
    Route::get('/product/wishlist',[ProductController::class, 'productWishlist']);
    Route::get('/product/detail/{id}',[ProductController::class, 'detail']);
    Route::post('/product/cart',[ProductController::class, 'productCart']);
    

    // middleware
    // Route::group(['middleware' => 'auth:api'], function(){
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/user/update/{id}',[MemberController::class, 'update']);
        
        Route::get('/user/my-product',[ProductController::class, 'myProduct']);
        Route::post('/user/product/add',[ProductController::class, 'store']);
        Route::get('/user/product/{id}',[ProductController::class, 'show']);
        Route::post('/user/product/update/{id}',[ProductController::class, 'update']);
        Route::get('/user/product/delete/{id}',[ProductController::class, 'deleteProduct']);
        Route::post('/blog/comment/{id}',[BlogController::class, 'comment']);
        Route::post('/blog/rate/{id}',[BlogController::class, 'rate']);
        

    });
    // // 
    Route::get('/blog/rate/{id}',[BlogController::class, 'rateBlog']);
    Route::get('/category-brand',[ProductController::class, 'listCategoryBrand']);
   

    //Blog Api
    // http:://..../api/blog
    Route::get('/blog',[BlogController::class, 'list']);
    Route::get('/blog/detail/{id}',[BlogController::class, 'show']);
    
    Route::get('/blog/detail-pagination/{id}',[BlogController::class, 'pagingBlogDetail']);


    // Route::get('testapi', 'TestApiController@index');
    // Route::post('testapi','TestApiController@store');
    // Route::get('testapi/{id}', 'TestApiController@show');
    // Route::put('testapi/{id}','TestApiController@update');
    // Route::delete('testapi/{id}', 'TestApiController@destroy');

});

