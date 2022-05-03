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
Route::get('/','BooksController@index');

//新しい「本」を追加 追加ボタンを押すとここにルーティングされる 本の情報を持っているので引数は$request
Route::post('/books','BooksController@store');

//本を削除 削除する本の情報渡したいので引数は$book
Route::delete('/book/{book}','BooksController@destroy');

//更新画面 削除する本の情報渡したいので引数は$book
Route::post('/booksedit/{books}','BooksController@edit');

//更新処理 更新内容を入力した情報を渡したいので$request
Route::post('/books/update', 'BooksController@update');
