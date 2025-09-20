<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    @yield('css')
</head>
<body>
    <header>
        <div class="site-title">FashionablyLate</div>
        <nav>
            <a href="{{ route('admin.index') }}">HOME</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>