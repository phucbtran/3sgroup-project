<?php

Route::get('/', function(){
    return view('public.home');
})->where('any', '.*');

//====admin=====
Route::prefix('admin')->group(function () {

    //login
    Route::get('login', function () {
        if (Auth::viaRemember() || Auth::check()) {
            return redirect()->intended('/admin/dashboard');
        }
        return view('admin.auth.login', ['msg' => null]);
    });
    Route::post('login', 'Auth\LoginController@login');
    
    //logout
    Route::get('logout', 'Auth\LoginController@logout');
    
    Route::group(['prefix' => '',  'middleware' => 'checkAuth'], function(){
        //dashboard
        Route::get('dashboard', function () {
            return view('admin.dashboard', ['msg' => null]);
        });

        //user
        Route::prefix('profile')->group(function(){
            Route::get('view', function () {
                return view('admin.profile.view', ['msg' => null]);
            });
            Route::get('change-password', function (){
                return view('admin.profile.change-password', ['msg' => null]);
            });
        });

        //staticpage
        Route::prefix('static-pages')->group(function(){
            Route::get('all', function () {
                return view('admin.staticpage.all', ['msg' => null]);
            });
            Route::get('new', function (){
                return view('admin.staticpage.new', ['msg' => null]);
            });
        });
    });
});