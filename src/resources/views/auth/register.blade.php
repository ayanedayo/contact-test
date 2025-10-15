<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
  <header class="header">
    <h1 class="logo">FashionablyLate</h1>
    <a href="{{ route('login') }}" class="login-btn">Login</a>
  </header>

  <main class="main">
    <h2 class="title">Register</h2>
    <div class="form-container">
        <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf
        <div class="form-group">
          <label for="name">お名前</label>
          <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
          @error('name')<p class="error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required>
          @error('email')<p class="error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
          <label for="password">パスワード</label>
          <input id="password" type="password" name="password" required>
          @error('password')<p class="error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">パスワード（確認）</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn">登録</button>
      </form>
    </div>
  </main>
</body>
</html>