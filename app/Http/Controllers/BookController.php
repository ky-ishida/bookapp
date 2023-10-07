<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Auth;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    // 一覧を取得する
    public function index()
    {
        $books = Book::orderBy('created_at', 'asc')->get();
        return view('books', ['books' => $books]);
    }

    // 更新画面
    public function edit(Book $books)
    {
        return view('update', ['book' => $books]);
    }
    // 更新処理
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required'

        ]);

        // バリデーションエラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $books = Book::find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();
        // 削除したあとはbookページにリダイレクト
        return  redirect('/');
    }

    // 新規本を追加する
    public function store(Request $request)
    {
        // 本の追加
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
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
    }

    // 削除処理
    public function destroy(Book $book){
        $book->delete();
        // 削除した後bookページにリダイレクト
        return redirect('/');
    }
}