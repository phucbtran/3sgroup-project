<?php

use App\Http\Controllers\NewsController;

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
        Route::prefix('lien-he')->group(function(){
            Route::get('', 'ContactsController@index')->name('contact.index');
            Route::delete('/xoa-tat-ca', 'ContactsController@destroyAll')->name('contact.remove_all');
        });
        // remove contact
        Route::delete('lien-he/{id}', 'ContactsController@destroy')->name('contact.remove');

        //categories
        Route::prefix('danh-muc')->group(function(){
            Route::get('', 'CategoriesController@index')->name('categories.index');
            Route::post('/them-moi', 'CategoriesController@store')->name('categories.store');
            Route::post('/cap-nhat/{id}', 'CategoriesController@update')->name('categories.update');
            Route::delete('/xoa/{id}', 'CategoriesController@destroy')->name('categories.remove');
        });

        //news
        Route::prefix('tin-tuc')->group(function(){
            Route::get('', 'NewsController@index')->name('news.index');
            Route::post('/them-moi', 'NewsController@store')->name('news.store');
            Route::get('/them-moi', function(){
                return view('admin.news.add');
            })->name('news.store');
            Route::get('/cap-nhat/{id}', 'NewsController@getNewsByID')->name('news.detail');
            Route::post('/cap-nhat/{id}', 'NewsController@update')->name('news.update');
            Route::delete('/xoa/{id}', 'NewsController@destroy')->name('news.remove');
        });

        //comment
        Route::prefix('binh-luan')->group(function(){
            Route::get('san-pham', 'CommentsController@indexProductComment')->name('comments.product');
            Route::get('hop-tac', 'CommentsController@indexCooperationComment')->name('comments.cooperation');
            Route::get('tin-tuc', 'CommentsController@indexNewComment')->name('comments.new');
            Route::post('/them-moi', 'CommentsController@store')->name('comments.store');
            Route::post('/cap-nhat/{id}', 'CommentsController@update')->name('comments.update');
            Route::delete('/xoa/{id}', 'CommentsController@destroy')->name('comments.remove');
            Route::delete('/xoa-tat-ca', 'CommentsController@destroyAll')->name('comments.remove_all');
        });
    });
});
