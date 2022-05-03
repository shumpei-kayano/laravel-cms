<?php

use Illuminate\Support\Facades\Route;
use app\Models\Book;
use Illuminate\Http\Request;

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
    //
});

//本を削除
Route::delete('/book/{book}',function (Book $book) {
    //
});