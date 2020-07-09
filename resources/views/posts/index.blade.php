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
@if (Auth::user())
<form action="{{route('logout')}}" method="post">
  @csrf
 <button>logout</button>
</form>
@endif
  </header>
  @foreach ($posts as $post)
  <p>投稿者: {{App\User::find($post->user_id)->name}}</p>
    <a href="{{route('posts.showdetail', ['post' => $post])}}">{{$post->title}}</a>
    <p>{{$post->content}}</p>
    コメント数 : <span>{{$post->comments()->get()->count()}}</span>
    <hr>
  @endforeach

</body>
</html>
