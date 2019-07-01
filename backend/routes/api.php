<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResources([
    'user'=>'Admin\API\UserController',
    'category'=>'Admin\API\CategoryController',
    'location'=>'Admin\API\LocationController',
    'tourist-route'=>'Admin\API\TouristRouteController',
    'tour'=>'Admin\API\TourController',
    'user-client'=>'Admin\API\UserClientController',
    'review'=>'Admin\API\ReviewController',
    'promotion'=>'Admin\API\PromotionController',
]);

Route::get('profile', 'Admin\API\UserController@profile');
Route::put('profile', 'Admin\API\UserController@updateProfile');
Route::put('profile/changepassword', 'Admin\API\UserController@changPassword');
Route::get('findUser', 'Admin\API\UserController@search');

Route::get('category/get/all', 'Admin\API\CategoryController@getListCategories');

Route::get('location/select/search', 'Admin\API\LocationController@searchSelect');

Route::get('tourist-route/select/search', 'Admin\API\TouristRouteController@searchSelect');

Route::get('promotion/select/search', 'Admin\API\PromotionController@searchSelect');