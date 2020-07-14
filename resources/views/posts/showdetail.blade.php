@extends('layouts.app')

@section('content')
  <p>タイトル</p>
  <span>{{$post->title}}</span> <br>
  <p>投稿者</p>
  <span>{{App\User::find($post->user_id)->name}}</span> <br>
  <p>作成日</p>
  <span>{{$post->created_at->format('yy/m/d')}}<span>
  <p>本文</p>
  <span>{{$post->content}}</span> <br> <br>
  @if (Auth::check() && Auth::user()->id == $post->user_id)
  <form action="{{route('posts.delete', ['post' => $post])}}" method="post">
    @csrf
    <button>delete</button>
    </form> <br>
  @endif
  <hr>
  @foreach ($post->comments()->get()->sortByDesc('created_at') as $comment)
    <span>{{$comment->created_at->format('yy/m/d G:i:s')}}</span> <br>
    <span>{{App\User::find($comment->user_id)->name}}</span> <br>
    <span>{{$comment->content}}</span> <br>
    <hr>
  @endforeach

  @if (Auth::check() && $post->user_id != Auth::user()->id)
  コメントを送信する <br>
  <form action="{{route('comments.create', ['post' => $post])}}" method="post">
   @csrf
   <label for="comment">本文</label> <br>
   <textarea name="content" id="comment" cols="20" rows="10">{{old('content')}}</textarea> <br>
   <button>コメントを送信</button>
  @endif
  </form>
@endsection
