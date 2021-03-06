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


Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

/**
 * Homepage route
 */

Route::get('/', 'Frontend\HomepageController@index')->name('home');
Route::get('login', 'Auth\Frontend\LoginController@login')->name('login');
Route::post('login', 'Auth\Frontend\LoginController@store')->name('login.store');
Route::get('register', 'Auth\Frontend\RegisterController@create')->name('register');
Route::post('register', 'Auth\Frontend\RegisterController@store')->name('register.store');
Route::get('logout', 'Auth\Frontend\LoginController@logout')->name('logout');
Route::get('forgot-password', 'Auth\Frontend\ForgotPasswordController@getEmail')->name('forgot_password.getEmail');
Route::post('forgot-password/send', 'Auth\Frontend\ForgotPasswordController@sendEmail')->name('forgot_password.sendEmail');
Route::get('forgot-password/token={token}', 'Auth\Frontend\ForgotPasswordController@getReset')->name('forgot_password');
Route::post('forgot-password/update/{token}', 'Auth\Frontend\ForgotPasswordController@resetPassword')->name('forgot_password.update');

Route::get('auth/{provider}', 'Auth\Frontend\LoginController@redirectToProvider')->name('provider');
Route::get('auth/{provider}/callback', 'Auth\Frontend\LoginController@handleProviderCallback')->name('provider.callback');

Route::get('profile', 'Frontend\GuestManagerController@show')->name('profile');
Route::get('profile/edit', 'Frontend\GuestManagerController@edit')->name('profile.edit');
Route::post('profile/update', 'Frontend\GuestManagerController@update')->name('profile.update');

Route::get('change-password', 'Frontend\GuestManagerController@editPassword')->name('change_password.edit');
Route::post('change-password/update', 'Frontend\GuestManagerController@updatePassword')->name('change_password.update');

//Route::get('provinces', 'Frontend\ProvinceController@index')->name('province');

Route::get('search/', 'Frontend\HomePageController@search')->name('search');
Route::get('search/country/{id}', 'Frontend\SearchController@searchByCountry')->where('id', '[0-9]+')->name('search.country');
Route::get('search/province/{id}', 'Frontend\SearchController@searchByProvince')->where('id', '[0-9]+')->name('search.province');
Route::get('search/category/{id}', 'Frontend\SearchController@searchByCategory')->where('id', '[0-9]+')->name('search.category');

Route::get('hotel', 'Frontend\HotelController@hotel')->name('hotel');

Route::get('booking', 'Frontend\HotelController@booking')->name('booking');
Route::post('booking/store', 'Frontend\BookingController@store')->name('booking.store');

Route::get('booking/list', 'Frontend\BookingManagerController@getBooking')->name('booking.list');

Route::get('comment', 'Frontend\StarRatingController@comment')->name('comment');
Route::get('star-booking', 'Frontend\StarRatingController@index')->name('booking.star');

Route::get('payment-vnpay', 'PaymentController@create')->name('payment-vnpay');
Route::get('return-vnpay', 'PaymentController@returnUrl')->name('return-vnpay');
Route::get('payment', 'PaymentController@payment')->name('payment');
/**
 * Admin route
 */

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('register', 'Auth\Admin\RegisterController@create')->name('register');
    Route::post('register', 'Auth\Admin\RegisterController@store')->name('register.store');

    Route::get('login', 'Auth\Admin\LoginController@login')->name('auth.login');
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('auth.loginAdmin');
    Route::get('logout', 'Auth\Admin\LoginController@logout')->name('auth.logout');
    Route::get('forgot-password', 'Auth\Admin\ForgotPasswordController@getEmail')->name('forgot_password.getEmail');
    Route::post('forgot-password/send', 'Auth\Admin\ForgotPasswordController@sendEmail')->name('forgot_password.sendEmail');
    Route::get('forgot-password/token={token}', 'Auth\Admin\ForgotPasswordController@getReset')->name('forgot_password');
    Route::post('forgot-password/update/{token}', 'Auth\Admin\ForgotPasswordController@resetPassword')->name('forgot_password.update');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', 'AdminController@index')->name('dashboard');
        Route::get('/dashboard', 'AdminController@index')->name('dashboard');

        Route::get('profile', 'Admin\AdminManagerController@show')->name('profile');
        Route::post('profile/update', 'Admin\AdminManagerController@update')->name('profile.update');
        Route::get('change-password', 'Auth\Admin\ResetPasswordController@index')->name('change_password');
        Route::post('change-password/update', 'Auth\Admin\ResetPasswordController@update')->name('change_password.update');

        Route::get('country', 'Admin\CountryController@index')->name('country');
        Route::get('country/create', 'Admin\CountryController@create')->name('country.create');
        Route::get('country/edit/{id}', 'Admin\CountryController@edit')->where('id', '[0-9]+')->name('country.edit');

        Route::post('country', 'Admin\CountryController@store')->name('country.store');
        Route::post('country/{id}', 'Admin\CountryController@update')->where('id', '[0-9]+')->name('country.update');
        Route::post('country/delete/{id}', 'Admin\CountryController@destroy')->where('id', '[0-9]+')->name('country.destroy');

        Route::get('province', 'Admin\ProvinceController@index')->name('province');
        Route::get('province/search', 'Admin\ProvinceController@getProvinces')->name('province.search');
        Route::get('province/create', 'Admin\ProvinceController@create')->name('province.create');
        Route::get('province/edit/{id}', 'Admin\ProvinceController@edit')->where('id', '[0-9]+')->name('province.edit');
        Route::get('province/{id}/hotels', 'Admin\HotelController@getHotels')->where('id', '[0-9]+')->name('province.hotel');

        Route::post('province', 'Admin\ProvinceController@store')->name('province.store');
        Route::post('province/{id}', 'Admin\ProvinceController@update')->where('id', '[0-9]+')->name('province.update');
        Route::post('province/delete/{id}', 'Admin\ProvinceController@destroy')->where('id', '[0-9]+')->name('province.destroy');

        Route::get('hotel/', 'Admin\HotelController@index')->name('hotel');
        Route::get('hotel/list_provinces', 'Admin\HotelController@getProvinces')->name('hotel.list_provinces');
        Route::get('hotel/list_hotels', 'Admin\HotelController@getHotelInProvince')->name('hotel.list_hotels');
        Route::get('hotel/search', 'Admin\HotelController@search')->name('hotel.search');
        Route::get('hotel/create', 'Admin\HotelController@create')->name('hotel.create');
        Route::get('hotel/edit/{id}', 'Admin\HotelController@edit')->where('id', '[0-9]+')->name('hotel.edit');
        Route::get('hotel/export/{id}', 'Admin\HotelController@export')->name('hotel.export');
        Route::get('hotel/{id}/rooms', 'Admin\RoomController@getRooms')->where('id', '[0-9]+')->name('hotel.room');

        Route::post('hotel', 'Admin\HotelController@store')->name('hotel.store');
        Route::post('hotel/{id}', 'Admin\HotelController@update')->where('id', '[0-9]+')->name('hotel.update');
        Route::post('hotel/delete/{id}', 'Admin\HotelController@destroy')->where('id', '[0-9]+')->name('hotel.destroy');
        Route::post('hotel/import', 'Admin\HotelController@import')->name('hotel.import');

        Route::get('room/type', 'Admin\RoomTypeController@index')->name('room.type');

        Route::get('room/list', 'Admin\RoomController@index')->name('room.list');

        Route::get('room/show/{id}', 'Admin\RoomController@show')->where('id', '[0-9]+')->name('room.show');
        Route::get('room/list_rooms', 'Admin\RoomController@getRoomInHotel')->name('room.list_rooms');
        Route::get('room/search', 'Admin\RoomController@search')->name('room.search');
        Route::get('room/create', 'Admin\RoomController@create')->name('room.create');
        Route::get('room/edit/{id}', 'Admin\RoomController@edit')->where('id', '[0-9]+')->name('room.edit');
        Route::get('room/export/{id}', 'Admin\RoomController@export')->name('room.export');

        Route::post('room', 'Admin\RoomController@store')->name('room.store');
        Route::post('room/{id}', 'Admin\RoomController@update')->where('id', '[0-9]+')->name('room.update');
        Route::post('room/delete/{id}', 'Admin\RoomController@destroy')->where('id', '[0-9]+')->name('room.destroy');
        Route::post('room/import', 'Admin\RoomController@import')->name('room.import');

        Route::get('room/facility/create', 'Admin\RoomFacilityController@create')->name('room.facility.create');
        Route::post('room/facility', 'Admin\RoomFacilityController@store')->name('room.facility.store');
        Route::post('room/facility/update/{id}', 'Admin\RoomFacilityController@update')->where('id', '[0-9]+')->name('room.facility.update');

        Route::get('room/detail', 'Admin\RoomDetailController@index')->name('room.detail');
        Route::get('room/list_hotels', 'Admin\RoomDetailController@getHotels')->name('room.list_hotels');
        Route::get('room/calendar', 'Admin\RoomDetailController@getRooms')->name('room.calendar');

        Route::get('guest', 'Admin\GuestController@index')->name('guest');
        Route::get('guest/create', 'Admin\GuestController@create')->name('guest.create');
        Route::get('guest/edit/{id}', 'Admin\GuestController@edit')->where('id', '[0-9]+')->name('guest.edit');
        Route::get('guest/star-rating/{id}', 'Admin\GuestController@getStarRating')->where('id', '[0-9]+')->name('guest.star_rating');
        Route::get('guest/export', 'Admin\GuestController@export')->name('guest.export');;

        Route::post('guest', 'Admin\GuestController@store')->name('guest.store');
        Route::post('guest/{id}', 'Admin\GuestController@update')->where('id', '[0-9]+')->name('guest.update');
        Route::post('guest/delete/{id}', 'Admin\GuestController@destroy')->where('id', '[0-9]+')->name('guest.destroy');
        Route::post('guest/import', 'Admin\GuestController@import')->name('guest.import');

        Route::get('booking', 'Admin\BookingManagerController@index')->name('booking');

        Route::get('star-rating', 'Admin\StarRatingController@index')->name('star_rating');
        Route::post('star-rating/delete/{id}', 'Admin\StarRatingController@destroy')->where('id', '[0-9]+')->name('star_rating.destroy');

    });
});
