<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;
// use Dotenv\Validator;
use Illuminate\Http\Request;
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
//本のダッシュボード表示
Route::get('/', function () {
    //created_atはDBに作成日時で登録されている
    $books = Book::orderBy('created_at', 'asc')->get();
    //books.blade.phpの呼び出し
    return view('books', [
        //view関数に配列データを渡したら、books.blade.phpビューの中で反復処理を行い、HTMLテーブル要素を作成して表示する。
        //'ビュー側で使用する変数名' => 値（変数/配列/オブジェクト）
        'books' => $books
    ]);
});

//新しい「本」を追加 追加ボタンを押すとここにルーティングされる 本の情報を持っているので引数は$request
Route::post('/books','BooksController@store');

//本を削除 削除する本の情報渡したいので引数は$book
Route::delete('/book/{book}',function (Book $book) {
    $book->delete(); //Modelクラスにdeleteメソッドが用意されている。
    return redirect('/');
});

//更新画面 削除する本の情報渡したいので引数は$book
Route::post('/booksedit/{books}',function (Book $books) {
    //{books}id 値を取得 => Book $books id 値の1レコード取得
    return view('booksedit', ['book' => $books]);
});

//更新処理 更新内容を入力した情報を渡したいので$request
Route::post('/books/update', 'BooksController@update');
