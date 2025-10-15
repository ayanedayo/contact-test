<!doctype html>
<html lang="ja">
<head><meta charset="utf-8"><title>お問い合わせ</title></head>
<body>
  <h1>お問い合わせフォーム</h1>

  @if ($errors->any())
    <ul style="color:red;">
      @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  @endif

  <form action="{{ route('contact.confirm') }}" method="POST">
    @csrf

    <div>
      姓：<input name="last_name"  value="{{ old('last_name') }}" required>
      名：<input name="first_name" value="{{ old('first_name') }}" required>
    </div>

    <div>
      メール：<input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
      電話：<input name="tel" value="{{ old('tel') }}" required>
    </div>

    <div>
      住所：<input name="address" value="{{ old('address') }}" required>
    </div>

    <div>
      建物名：<input name="building" value="{{ old('building') }}" required>
    </div>

    <div>
      性別：
      <label><input type="radio" name="gender" value="1" {{ old('gender')=='1'?'checked':'' }}>男性</label>
      <label><input type="radio" name="gender" value="2" {{ old('gender')=='2'?'checked':'' }}>女性</label>
      <label><input type="radio" name="gender" value="3" {{ old('gender')=='3'?'checked':'' }}>その他</label>
    </div>

    <div>
      お問い合わせ種別：
      <select name="category_id" required>
  <option value="">お問い合わせ種類</option>
  @foreach ($categories as $c)
    <option value="{{ $c->id }}"
      {{ old('category_id') == $c->id ? 'selected' : '' }}>
      {{ $c->content }}
    </option>
  @endforeach
</select>
      </select>
    </div>

    <div>
      内容：<br>
      <textarea name="detail" rows="6" required>{{ old('detail') }}</textarea>
    </div>

    <button type="submit">確認</button>
  </form>
</body>
</html>