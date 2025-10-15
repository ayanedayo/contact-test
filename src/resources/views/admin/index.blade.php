@extends('admin.layout')

@section('title','お問い合わせ一覧')

@section('content')
<div x-data="{ open:false, item:null }">
  
  <form method="GET" action="{{ route('admin.index') }}" class="filter-row">
    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前・メールアドレス" class="btn" style="min-width:260px">
    <select name="gender" class="btn">
      <option value="">性別</option>
      <option value="1" @selected(request('gender')==='1')>男性</option>
      <option value="2" @selected(request('gender')==='2')>女性</option>
      <option value="3" @selected(request('gender')==='3')>その他</option>
    </select>
    <select name="category_id" class="btn">
      <option value="">お問い合わせの種類</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}" @selected(request('category_id')==$c->id)>{{ $c->content }}</option>
      @endforeach
    </select>
    <input type="date" name="from" class="btn" value="{{ request('from') }}">
    <span>〜</span>
    <input type="date" name="to" class="btn" value="{{ request('to') }}">
    <button class="btn">検索</button>
    <a class="btn" href="{{ route('admin.index') }}">リセット</a>
    <a class="btn" href="{{ route('admin.export') }}">エクスポート</a>
  </form>

  
  <table>
    <thead>
      <tr>
        <th>お名前</th><th>性別</th><th>メールアドレス</th><th>お問い合わせ種類</th><th>作成日</th><th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($contacts as $contact)
        <tr>
          <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
          <td>{{ ['','男性','女性','その他'][$contact->gender] ?? '' }}</td>
          <td>{{ $contact->email }}</td>
          <td>{{ optional($contact->category)->content }}</td>
          <td>{{ $contact->created_at->format('Y-m-d') }}</td>
          <td>
            <button class="btn"
              @click="
                item = {
                  id: @js($contact->id),
                  name: @js($contact->last_name.' '.$contact->first_name),
                  gender: @js(['','男性','女性','その他'][$contact->gender] ?? ''),
                  email: @js($contact->email),
                  tel: @js($contact->tel),
                  address: @js($contact->address),
                  building: @js($contact->building),
                  category_label: @js(optional($contact->category)->content),
                  detail: @js($contact->detail)
                };
                open = true;
              "
            >詳細</button>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" style="text-align:center;color:#777;padding:16px">データがありません</td></tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top:12px">{{ $contacts->links() }}</div>

  <template x-if="open">
    <div class="overlay" @click.self="open=false">
      <div class="modal" @keydown.escape.window="open=false">
        <header>
          <h3 style="font-size:18px;font-weight:700">詳細</h3>
          <button class="btn" @click="open=false">×</button>
        </header>
        <div class="content">
          <div class="grid">
            <div>お名前</div><div x-text="item?.name"></div>
            <div>性別</div><div x-text="item?.gender"></div>
            <div>メール</div><div x-text="item?.email"></div>
            <div>電話</div><div x-text="item?.tel"></div>
            <div>住所</div><div x-text="item?.address"></div>
            <div>建物名</div><div x-text="item?.building"></div>
            <div>お問い合わせ種類</div><div x-text="item?.category_label"></div>
            <div>内容</div><div x-text="item?.detail"></div>
          </div>
        </div>
        <div class="footer">
          <form x-bind:action="`{{ route('admin.destroy','__ID__') }}`.replace('__ID__', item?.id)" method="POST"
                onsubmit="return confirm('削除しますか？')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
          </form>
          <button class="btn" @click="open=false">閉じる</button>
        </div>
      </div>
    </div>
  </template>
</div>
@endsection