<?php

use App\Book;
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
Route::get('/', function () {
    $books = Book::orderBy('created_at', 'asc')->get();
    return view('books', ['books' => $books]);
});
// 本の追加
Route::post('/books', function (Request $request) {
    // 本の追加
    $validator = Validator::make($request->all(), [
        'item_name' => 'required|max255',
        'item_number' => 'required|min1|max3',
        'item_amount' => 'required|max6',
        'published' => 'required'

    ]);

    // バリデーションエラー
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $books = new Book;
    $books->item_name = $request->item_name;
    $books->item_number = $request->item_number;
    $books->item_amount = $request->item_amount;
    $books->published = $request->published;
    $books->save();
    // 削除したあとはbookページにリダイレクト
    return  redirect('/');
});

// データーの削除
Route::delete('/book/{book}', function (Book $book) {
    $book->delete();
    // 削除した後bookページにリダイレクト
    return redirect('/');
});

// データの更新する
Route::post(
    '/update/{books}',
    function (Book $books) {
        // {books}id値を取得→BOOK ＄book　id値の１レコードを取得する
        return view('update', ['book' => $books]);
    }
);

// ログイン認証機能を呼び出すコマンド
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
