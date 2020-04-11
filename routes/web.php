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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/archives','HomeController@archives');
Route::get('/detail','HomeController@detail');
Route::get('/gustBook','HomeController@gustBook');
Route::get('/link','HomeController@link');
Route::get('/search','HomeController@search');
Route::get('/update','HomeController@update');

Route::prefix('admin')->group(function () {
    Route::get('login','AdminController@getLoginView');
    Route::post('login','AdminController@login');

    Route::get('index', 'AdminController@index');
    Route::post('logout','AdminController@logout');

    Route::get('board','AdminController@board');
    Route::post('board','AdminController@addBoard');
    Route::put('board','AdminController@modifyBoard');
    Route::delete('board','AdminController@deleteBoard');

    Route::get('label','AdminController@label');
    Route::post('label','AdminController@addLabel');
    Route::put('label','AdminController@modifyLabel');
    Route::delete('label','AdminController@deleteLabel');

    Route::post('uploadImg','AdminController@uploadPicture');
    Route::get('article','AdminController@article');
    Route::get('getAllLabels','AdminController@getAllLabels');
    Route::get('getArticleLabels','AdminController@getArticleLabels');
    Route::get('newArticle','AdminController@getNewArticle');
    Route::post('article','AdminController@addArticle');
    Route::get('modifyArticle','AdminController@getModifyArticle');
    Route::put('article','AdminController@modifyArticle');
    Route::delete('article','AdminController@deleteArticle');

});

