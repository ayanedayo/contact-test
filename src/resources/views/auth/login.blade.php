{{-- login.blade.php --}}
<form method="POST" action="{{ route('login') }}">
  @csrf
  <div><label>メールアドレス</label><input type="email" name="email" required></div>
  <div><label>パスワード</label><input type="password" name="password" required></div>
  <button type="submit">ログイン</button>
</form>