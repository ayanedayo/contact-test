<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title>@yield('title', 'Admin')</title>
  
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;}
    .container{max-width:960px;margin:24px auto;padding:0 16px;}
    table{width:100%;border-collapse:collapse;margin-top:12px}
    th,td{border-bottom:1px solid #e5e7eb;padding:10px 8px;text-align:left}
    th{background:#fafafa}
    .btn{padding:6px 10px;border:1px solid #ccc;border-radius:6px;background:#f5f5f5;cursor:pointer}
    .btn-danger{background:#ffe5e5;border-color:#f3b6b6}
    .filter-row{display:flex;gap:8px;flex-wrap:wrap;align-items:center;margin:12px 0}
    
    .overlay{position:fixed;inset:0;background:rgba(0,0,0,.4);display:flex;align-items:center;justify-content:center}
    .modal{background:#fff;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,.2);width:min(760px,92vw)}
    .modal header{display:flex;justify-content:space-between;align-items:center;padding:14px 18px;border-bottom:1px solid #eee}
    .modal .content{padding:18px}
    .grid{display:grid;grid-template-columns:140px 1fr;row-gap:10px;column-gap:18px}
    .footer{display:flex;justify-content:flex-end;gap:8px;padding:0 18px 18px}
  </style>
</head>
<body>
  <div class="container">
    <header style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
      <h1 style="font-size:28px;font-weight:800">FashionablyLate Admin</h1>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn">logout</button>
      </form>
    </header>
    <main>
      @yield('content')
    </main>
  </div>
</body>
</html>