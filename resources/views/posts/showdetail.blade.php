<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <p>タイトル</p>
  <span>{{$post->title}}</span> <br>
  <p>作成日</p>
  <span>{{$post->created_at->format('yy/m/d')}}<span>
  <p>本文</p>
  <span>{{$post->content}}</span> <br>
  <form action="{{route('posts.delete', ['post' => $post])}}" method="post">
  @csrf
  <button>delete</button>
  </form>
</body>
</html>
