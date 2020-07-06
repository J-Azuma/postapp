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
  <span>{{$post->content}}</span> <br> <br>
  <form action="{{route('posts.delete', ['post' => $post])}}" method="post">
  @csrf
  <button>delete</button>
  </form> <br>
  <hr>
  @foreach ($post->comments()->get()->sortByDesc('created_at') as $comment)
    <span>{{$comment->created_at->format('yy/m/d G:i:s')}}</span> <br>
    <span>{{$comment->content}}</span> <br>
    <hr>
  @endforeach

  コメントを送信する <br>
  <form action="{{route('comments.create', ['post' => $post])}}" method="post">
   @csrf
   <label for="comment">本文</label> <br>
   <textarea name="content" id="comment" cols="20" rows="10">{{old('content')}}</textarea> <br>
   <button>コメントを送信</button>
  </form>
</body>
</html>
