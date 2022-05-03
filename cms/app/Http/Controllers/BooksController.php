<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Auth;

class BooksController extends Controller
{
    //本ダッシュボード表示
    public function index()
    {
        //created_atはDBに作成日時で登録されている
        $books = Book::orderBy('created_at', 'asc')->paginate(3);
        //books.blade.phpの呼び出し
        return view('books', [
            //view関数に配列データを渡したら、books.blade.phpビューの中で反復処理を行い、HTMLテーブル要素を作成して表示する。
            //'ビュー側で使用する変数名' => 値（変数/配列/オブジェクト）
            'books' => $books
        ]);
    }

    //削除処理
    public function destroy(Book $book)
    {
        $book->delete(); //Modelクラスにdeleteメソッドが用意されている。
        return redirect('/');
    }

    //更新画面
    public function edit(Book $book)
    {
        //{books}id 値を取得 => Book $books id 値の1レコード取得
        return view('booksedit', [
            'book' => $book
        ]);
    }

    //更新
    public function update(Request $request)
    {
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
    }

    //登録
    public function store(Request $request)
    {
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
    }
}
