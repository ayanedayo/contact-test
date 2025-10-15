<!doctype html>
<html lang="ja">
<head><meta charset="utf-8"><title>確認</title></head>
<body>
<h2>Confirm</h2>

<form method="POST" action="{{ route('contact.store') }}">
  @csrf
  @foreach($inputs as $k => $v)
    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
  @endforeach

  <p>氏名：{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</p>
  <p>メール：{{ $inputs['email'] }}</p>
  <p>電話：{{ $inputs['tel'] }}</p>
  <p>住所：{{ $inputs['address'] }}</p>
  <p>建物名：{{ $inputs['building'] ?? '' }}</p>
  <p>性別：{{ ['1'=>'男性','2'=>'女性','3'=>'その他'][$inputs['gender']] }}</p>
  <p>問い合わせ種別ID：{{ $inputs['category_id'] }}</p>
  <p>内容：{!! nl2br(e($inputs['detail'])) !!}</p>

  <button type="submit">送信</button>
</form>

<form method="GET" action="{{ route('contact.index') }}">
  <button type="submit">修正</button>
</form>
</body>
</html>