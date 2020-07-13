@extends('layouts.app')

@section('content')
  @if (Auth::check())
  <h3>Add Post</h3>
  @if ($errors->any())
  @foreach ($errors->all() as $message)
  <li>{{$message}}</li>
  @endforeach
  @endif
  <form action="{{route('posts.create')}}" method="post">
    @csrf
    <label for="post-title">title</label> <br>
    <input type="text" id="post-title" name="title" value="{{old('title')}}"> <br>
    <label for="post-content">content</label> <br>
    <textarea name="content" id="post-content" cols="20" rows="10">{{old('content')}}</textarea> <br>
    <button>submit</button>
  </form>
  @endif
  <hr>
  @foreach ($posts as $post)
  <p>投稿者: <a href="{{route('users.showdetail', ['user' => App\User::find($post->user_id)])}}">
      {{App\User::find($post->user_id)->name}}</a></p>
  <a href="{{route('posts.showdetail', ['post' => $post])}}">{{$post->title}}</a>
  <p>{{$post->content}}</p>
  コメント数 : <span>{{$post->comments()->get()->count()}}</span>
  <hr>
  @endforeach

  {{$posts->links()}}
@endsection
