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
            {{--  本のタイトル  --}}
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" name="item_name" class="form-control">
                </div>
            </div>

            {{--  本登録ボタン  --}}
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    {{--  Book:既に登録されてる本のリスト  --}}

@endsection