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

// Authentication Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('admin/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('admin/register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset');

//Route::get('/home', 'HomeController@index')->name('home');

// Route::get('{path}','HomeController@index')->where( 'path', '([A-z\d\-/_.]+)?' );

Route::get('invoice', function () {
    return view('invoice');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'admin'], function () {
        
        Route::get('home', 'HomeController@index')->name('admin/home');
        Route::get('/', 'HomeController@returnHome');

        Route::get('dashboard', 'HomeController@index');
        Route::get('category', 'HomeController@index');
        Route::group(['prefix' => 'tourist-route'], function () {
            Route::get('/', 'HomeController@index');
            Route::get('/add', 'HomeController@index');
            Route::get('/edit/{tr_id}', 'HomeController@index');
        });
        Route::group(['prefix' => 'tour'], function () {
            Route::get('/', 'HomeController@index');
            Route::get('/add', 'HomeController@index');
            Route::get('/edit/{tour_id}', 'HomeController@index');
        });
        Route::group(['prefix' => 'news'], function () {
            Route::get('/', 'HomeController@index');
            Route::get('/add', 'HomeController@index');
            Route::get('/edit/{news_id}', 'HomeController@index');
        });

        Route::get('user-client', 'HomeController@index');
        Route::get('reviews', 'HomeController@index');
        Route::get('promotion', 'HomeController@index');
        Route::get('developer', 'HomeController@index');
        Route::get('users', 'HomeController@index');
        Route::get('profile', 'HomeController@index');
        Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d\-/_.]+)?');
    });
});

Route::group(['namespace' => 'Client'], function () {
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/','HomeController@Index')->name('homeClient');

        Route::get('/search','SearchController@getSearch');
        Route::get('/search/ajax','SearchController@getSearchAjax');


        Route::get('/', 'HomeController@Index')->name('homeClient');
        Route::get('/tour/{code}', 'TourDetailController@Index');
        Route::post('/tour/comment/{code}', 'TourDetailController@postComment')->name('postComment');
        Route::get('/personal', 'PersonalController@Index')->name('personal');
        Route::post('/personal/update', "PersonalController@UpdateProfile")->name('personalUpdateProfile');
        Route::get('/booking/{code}',"BookingController@Index");
        Route::post('/booking/book/{code}',"BookingController@BookTour");
        Route::get('/tours-gio-chot',"HomeController@IndexToursLastHour")->name('toursLastHour');
        Route::get('/tours-dang-hot',"HomeController@IndexToursHot")->name('toursHot');
        Route::get('/tours-moi-nhat',"HomeController@IndexToursLatest")->name('toursLatest');
        Route::get('/hoat-dong/{id}',"HomeController@IndexActivity");
        Route::get('/personal', 'PersonalCOntroller@Index')->name('personal');

    });
});

Route::post('clients/register', 'AuthClient\RegisterController@register')->name('registerClient');
Route::post('clients/login', 'AuthClient\LoginController@login')->name('loginClient');
Route::post('clients/logout', 'AuthClient\LoginController@logout')->name('logoutClient');