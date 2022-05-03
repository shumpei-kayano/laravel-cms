{{--  layouts/app.blade.phpに書かれたHTMLファイルパーツを読み込む（親テンプレートの読み込み）  --}}
@extends('layouts.app')

{{--  名前をつけて一括りにする（親テンプレートのyield('content')の箇所に挿入される）  --}}
@section('content')
    <div class="card-body">
        <div class="card-title">
            本のタイトル
        </div>

        {{--  バリデーションエラー表示に使用common/errors.blade.phpを読み込む  --}}
        @include('common.errors')
        {{--  バリデーションエラー表示に使用  --}}

        {{--  本登録フォーム  --}}
        <form action="{{ url('books') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{--  本のタイトル  --}}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="book" class="col-sm-3 control-label">Book</label>
                    <input type="text" name="item_name" class="form-control">
                </div>
                
                <div class="form-group col-md-6">
                    <label for="amount" class="col-sm-3 control-label">金額</label>
                    <input type="text" name="item_amount" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="number" class="col-sm-3 control-label">数</label>
                    <input type="text" name="item_number" class="form-control">
                </div>
                
                  <div class="form-group col-md-6">
                    <label for="published" class="col-sm-3 control-label">公開日</label>
                    <input type="date" name="published" class="form-control">
                </div>    
            </div>
            
            <!-- 本 登録ボタン -->
            <div class="form-row">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                    Save
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    {{--  現在の本  --}}
    @if (count($books) > 0)
    <div class="card-body">
        <div class="card-title">
            現在の本
        </div>
        <table class="table table-striped task-table">
            {{--  テーブルヘッダ  --}}
            <thead>
                <th>本一覧</th>
                <th>&nbsp;</th>
            </thead>
            {{--  テーブル本体  --}}
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        {{--  本タイトル  --}}
                        <td class="table-text">
                            <div>{{ $book->item_name }}</div>
                        </td>

                        {{--  本更新ボタン  --}}
                        <td>
                            <form action="{{ url('booksedit/'.$book->id) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">
                                    更新
                                </button>
                            </form>
                        </td>
                        {{--  本削除ボタン  --}}
                        <td>
                            <form action="{{ url('book/'.$book->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{--  送信メソッドをdeleteに見せかけた擬似的メソッド  --}}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger">
                                    削除
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    {{--  Book：既に登録されている本のリスト  --}}
@endsection