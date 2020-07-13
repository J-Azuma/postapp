<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <header>
    <a href="{{route('home')}}">Sample App</a>
    |
    @if (Auth::user())
    <a href="{{route('logout')}}">logout</a>
    |
    <!-- 検索フォーム-->
    <form action="{{route('posts.index')}}" method="get">
      @csrf
      <input type="text" name="keyword" value="{{$keyword}}" placeholder="unko" >
      <button>search</button>
     </form>
    @else
    <a href="{{route('login')}}">login</a>
    @endif
  </header>
  <main>
    @yield('content')
  </main>
</body>
</html>
