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
Route::post('/books',function (Request $request) {
    //バリデーション all()は入力値を全て連想配列で取得
    $validator = Validator::make($request->all(), [
        //複数のバリデーションの設定が可能↓
        'item_name' => 'required|max:255',
        'item_number' => 'required|min:1|max:3',
        'item_amount' => 'required|max:6',
        'published' => 'required',
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
    $books -> item_number = $request->item_number;
    $books -> item_amount = $request->item_amount;
    $books -> published = $request->published;
    $books -> save(); //ModelクラスがDB登録のsaveメソッドを持っている。
    return redirect('/');
});

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
Route::post('/books/update', function(Request $request){
    //バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required',
    ]);
    //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
    }
    //データ更新 更新処理のため、newでレコードの生成ではなくfindメソッドを利用
    //モデル::find('id値');とすることで等しいレコードを取り出す
    $books = Book::find($request->id);
    $books->item_name   = $request->item_name;
    $books->item_number = $request->item_number;
    $books->item_amount = $request->item_amount;
    $books->published   = $request->published;
    $books->save();
    return redirect('/');
});
