@extends('layouts.app')

@section('content')
  name: {{$user->name}} <br>
  register date :{{$user->created_at->format('yy/m/d')}} <br>
  profile : {{$user->profile}} <br>

  posts <br>
  @foreach ($posts as $post)
  <p>タイトル</p>
  <a href="{{route('posts.showdetail', ['post' => $post])}}">{{$post->title}}</a> <br>
  <p>作成日</p>
  <span>{{$post->created_at->format('yy/m/d')}}<span>
  <p>本文</p>
  <span>{{$post->content}}</span> <br> <br>
  <hr>
  @endforeach

  @if (Auth::check() && Auth::user()->id == $user->id)
  <a href="{{route('users.showeditform', ['user' => $user])}}">登録情報を編集する</a>
  @endif
@endsection
