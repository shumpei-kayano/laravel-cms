<?php

use Illuminate\Support\Facades\Route;
use app\Models\Book;
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
    return view('books');
});

//新しい「本」を追加
Route::post('/books',function (Request $request) {
    //バリデーション all()は入力値を全て連想配列で取得
    $validator = Validator::make($request->all(), [
        //複数のバリデーションの設定が可能↓
        'item_name' => 'required|max:255',
    ]);

    //バリデーションエラー
    if ($validator->fails()) {
        return redirect('/') //ルートへリダイレクト
            ->withInput() //セッションに値を保存
            ->withErrors($validator);
    }
    //Eloquentモデル
    $books = new Book;
    $books -> item_name = $request->item_name;
    $books -> item_number = '1';
    $books -> item_amount = '1000';
    $books -> publiched = '2017-03-07 00:00:00';
    $books -> save(); //ModelクラスがDB登録のsaveメソッドを持っている。
    return redirect('/');
});

//本を削除
Route::delete('/book/{book}',function (Book $book) {
    //
});