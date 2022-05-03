{{--  layoutsフォルダはパーツ保管場所のイメージ  --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book List</title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            {{--  ナビバーの内容  --}}
        </nav>
    </div>
    {{--  yieldはパーツ配置キーワード  --}}
    @yield('content')
</body>
</html>