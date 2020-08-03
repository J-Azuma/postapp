<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- bootstrap -->
  <link rel="stylesheet" href="/css/styles.css">
  <title>Document</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-primary bg-dark">
      <span class="navbar-text navbar-brand"><a href="{{route('home')}}">Sample App</a></span>
      <!-- 検索フォーム-->
        <form action="{{route('posts.index')}}" method="get" class="form-inline">
          @csrf
          <div class="input-group">
            <input type="text" name="keyword"  placeholder="key word..." class="form-control">
          </div>
          <div class="input-group-append">
            <button class="btn btn-secondary bg-blue">search</button>
          </div>
         </form>
    @if (Auth::user())
    <a href="{{route('users.showdetail', ['user' => Auth::user()])}}" style="color:white">{{Auth::user()->name}}</a>
    <form action="{{route('logout')}}" method="post">
      @csrf
      <button>logout</button>
    </form>
    @else
    <a href="{{route('login')}}">login</a>
    @endif
  </nav>
  </header>
  <main>
    @yield('content')
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  @yield('scripts')
</body>
</html>
