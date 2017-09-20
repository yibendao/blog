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
//    echo '<img src="'.asset('imgsys/20170911/ef7548447d7ee819cb345e0df40614da.jpeg').'">';
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('resource-upload','ResourceController@upload');
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function () {
    //ajax通用路由
    Route::resource('ajax','AjaxController');
    Route::post('ajax/destroyAll','AjaxController@destroyAll');

    Route::get('/','IndexController@index');
    //文章路由
    Route::get('article-list','ArticleController@index');
    Route::get('article-create','ArticleController@create');
    Route::get('article-show','ArticleController@show');
    Route::get('article-edit/{id}','ArticleController@edit');
    Route::post('article-update','ArticleController@update');
    Route::post('article-store','ArticleController@store');
    Route::post('article-delete','ArticleController@delete');

    //文章分类路由
    Route::get('article-category-list','ArticleCategoryController@index');
    Route::get('article-category-create','ArticleCategoryController@create');
    Route::get('article-category-show','ArticleCategoryController@show');
    Route::get('article-category-edit','ArticleCategoryController@edit');
    Route::get('article-category-update','ArticleCategoryController@update');
    Route::post('article-category-store','ArticleCategoryController@store');
    Route::post('article-category-delete','ArticleCategoryController@delete');

    //用户路由
    Route::get('member-list','MemberController@index');
    Route::get('member-vip-list','MemberController@index');
    Route::get('member-create','MemberController@create');
    Route::get('member-show','MemberController@show');
    Route::get('member-edit','MemberController@edit');
    Route::post('member-update','MemberController@update');
    Route::post('member-store','MemberController@store');
    Route::post('member-delete','MemberController@delete');


});

Route::get('imgsys/{one?}/{two?}/{three?}/{four?}/{five?}/{six?}/{seven?}/{eight?}/{nine?}','ResourceController@getRealImagePath');
