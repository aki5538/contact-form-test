<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - 登録</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <header class="header">
        <div class="site-name">FashionablyLate</div>
        <div class="nav-link">
            <a href="{{ route('login') }}">ログイン</a>
        </div>
    </header>

    <main class="main">
        <h1>Register</h1>

        <form method="POST" action="{{ route('register') }}" class="form-box">
            @csrf

            <label for="name">お名前</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="鈴山 遥">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="email">メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="test@example.com">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">パスワード</label>
            <input type="password" name="password" placeholder="ouchthatrocks">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="button-wrapper">
                <button type="submit" class="login-button">登録</button>
            </div>
        </form>
    </main>
</body>
</html>