<?php

Route::get('/', function(){
    return view('public.home');
})->where('any', '.*');

//====admin=====
Route::prefix('admin')->group(function () {

    //login
    Route::get('login', function () {
        if (Auth::viaRemember() || Auth::check()) {
            return redirect()->intended(route('dashboard'));
        }
        return view('admin.auth.login', ['msg' => null]);
    })->name('login.index');
    Route::post('login', 'Auth\LoginController@login')->name('login.login');

    //logout
    Route::get('logout', 'Auth\LoginController@logout');

    Route::group(['prefix' => '',  'middleware' => 'checkAuth'], function(){
        //dashboard
        Route::get('dashboard', function () {
            return view('admin.dashboard', ['msg' => null]);
        })->name('dashboard');

        //profile
        Route::prefix('profile')->group(function(){
            Route::get('view', function () {
                return view('admin.profile.view', ['msg' => null]);
            });
            Route::get('change-password', function (){
                return view('admin.profile.change-password', ['msg' => null]);
            });
        });

        //users
        Route::prefix('user')->group(function(){
            Route::get('', 'UsersController@index');
            Route::post('/create', 'UsersController@create');
            Route::post('/{id}/update', 'UsersController@update');
            Route::delete('/{id}', 'UsersController@destroy');
        });

        // contact
        Route::get('lien-he', 'ContactsController@index')->name('contact.index');
        // remove contact
        Route::delete('lien-he/{id}', 'ContactsController@destroy')->name('contact.remove');
    });
});
