<?php

Route::get('/', function(){
    return view('public.home');
})->where('any', '.*');

Route::get('/lien-he', function(){
    return view('public.contact');
});

Route::post('/lien-he', 'ContactsController@create');

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
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['prefix' => '',  'middleware' => 'checkAuth'], function(){
        //dashboard
        Route::get('dashboard', function () {
            return view('admin.dashboard', ['msg' => null]);
        })->name('dashboard');

        //profile
        Route::post('trang-ca-nhan', 'UsersController@updateProfile')->name('profile.update');

        //users
        Route::prefix('user')->group(function(){
            Route::get('', 'UsersController@index')->name('user.index');
            Route::post('/them-moi', 'UsersController@create')->name('user.create');
            Route::post('/cap-nhat/{id}', 'UsersController@update')->name('user.update');
            Route::delete('/xoa/{id}', 'UsersController@destroy')->name('user.remove');
        });

        // contact
        Route::get('lien-he', 'ContactsController@index')->name('contact.index');

        // remove contact
        Route::delete('lien-he/{id}', 'ContactsController@destroy')->name('contact.remove');

        //categories
        Route::prefix('danh-muc')->group(function(){
            Route::get('', 'CategoriesController@index')->name('categories.index');
            Route::post('/them-moi', 'CategoriesController@store')->name('categories.store');
            Route::post('/cap-nhat/{id}', 'CategoriesController@update')->name('categories.update');
            Route::delete('/xoa/{id}', 'CategoriesController@destroy')->name('categories.remove');
        });
    });
});
