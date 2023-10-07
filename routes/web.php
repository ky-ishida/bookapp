<?php

use App\Book;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
// 登録してあるデーター一覧を取得する
Route::get('/', 'BookController@index');
// 本の追加
Route::post('/books', 'BookController@store');

// データーの削除
Route::delete('/book/{book}', 'BookController@destroy');
// データの更新画面
Route::post('/update/{books}', 'BookController@edit');
// 更新処理
Route::post('/books/update', 'BookController@update');
// ログイン認証機能を呼び出すコマンド
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
