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

Route::group(['middleware'=>'web'],function(){
    Route::match(['get','post'],'/',['uses'=>'IndexController@execute','as'=>'home']);
    Route::get('/page/{alias}',['uses'=>'PageController@execute','as'=>'page']);

    Route::auth();
});

Route::group(['prefix'=>'admin','middleware'=>'auth'],function (){
    //admin
    Route::get('/',function (){
        $data = ['title'=>'Панель администратора'];
        return view('admin.index',['title'=>'Панель администратора']);
    });

    //admin/pages
    Route::group(['prefix'=>'pages'],function (){
        Route::get('/',['uses'=>'PagesController@execute','as'=>'pages']);
        //admin/pages/add
        Route::match(['get','post'],'/add',['uses'=>'PagesController@execute','as'=>'pagesAdd']);

        Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PagesEditController@execute','as'=>'pagesEdit']);
    });

    Route::group(['prefix'=>'portfolio'],function (){
        Route::get('/',['uses'=>'PortfolioController@execute','as'=>'portfolio']);
        //admin/portfolio/add
        Route::match(['get','post'],'/add',['uses'=>'PortfolioController@execute','as'=>'portfolioAdd']);

        Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'PortfolioEditController@execute','as'=>'portfolioEdit']);
    });

    Route::group(['prefix'=>'services'],function (){
        Route::get('/',['uses'=>'ServicesController@execute','as'=>'services']);
        //admin/services/add
        Route::match(['get','post'],'/add',['uses'=>'ServicesController@execute','as'=>'servicesAdd']);

        Route::match(['get','post','delete'],'/edit/{services}',['uses'=>'ServicesEditController@execute','as'=>'servicesEdit']);
    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
