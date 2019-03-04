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

Route::get('/',"HomeController@index")->name('root');
Route::post('/','HomeController@search');
Route::get('/filter',"HomeController@catFilter");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth'],function(){
    Route::get('/email_verify_notice', 'HomeController@emailVerifyNotice')->name('email_verify_notice');
    Route::get('/email_verification/verify', 'EmailVerificationController@verify')->name('email_verification.verify');
    Route::get('/email_verification/send', 'EmailVerificationController@send')->name('email_verification.send');
    Route::group(['middleware' => 'email_verified'], function() {
        Route::get('publish','BookController@getPublishView');
        Route::post('publish','BookController@store');
        Route::get('mybooks', 'BookController@getAllBooksByOwner');
        Route::get('mybooks/{book}', 'BookController@getBookByOwner')->name('mybooks');
        Route::get('mybooks/{book}/edit', 'BookController@editBookByOwner');
        Route::post('mybooks/{book}/edit', 'BookController@updateBookByOwner');
        Route::get('mybooks/{book}/delete', 'BookController@deleteBookByOwner');
        Route::get('info','UserController@editInfo');
        Route::get('express', 'ShippingController@editExpress');
        Route::post('info', "UserController@updateInfo");
        Route::post('express', 'ShippingController@updateExpress');
        Route::get('sell_book', 'OrderController@createOrder');
        Route::get('wants', 'BookController@getAllWants');
        Route::post('book/{book}/favorite', 'BookDetailController@favor')->name('book.favor');
        Route::delete('book/{book}/favorite', 'BookDetailController@disfavor')->name('book.disfavor');
        Route::get('book/favorites', 'BookDetailController@favorites')->name('book.favorites');
        Route::post('book/{book}/want', 'BookDetailController@want')->name('book.want');
        Route::delete('book/{book}/want', 'BookDetailController@diswant')->name('book.diswant');
        Route::POST('/message', 'BookDetailController@message')->name('book.message');
        Route::get('order', 'OrderController@index');
        Route::get('update_order','OrderController@update');
        Route::get('book/{book}', 'BookDetailController@index')->name('book.index');
    });
});