@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <h2 class="col-sm-12">User Profile</h2> <br>
    @if (Auth::user() && Auth::user()->id == $user->id)
      <a href="{{route('users.showeditform', ['user' => $user])}}" class="badge badge-secondary">edit</a>
      @endif
    <table class="table table-striped table-bordered">
      <tr>
        <td>name</td>
        <td>{{$user->name}}</td>
      </tr>
      <tr>
        <td>register date</td>
        <td>{{$user->created_at->format('yy/m/d')}}</td>
      </tr>
      <tr>
        <td>profile</td>
        <td>{{$user->profile}}</td>
      </tr>
    </table>
  </div>
  <h2>posts</h2>
  @if ($posts->isEmpty())
  <p>no post</p>
  @endif
  @foreach ($posts as $post)
  <nav class="card">
    <div class="card-header"><a href="{{route('posts.showdetail', ['post' => $post])}}">{{$post->title}}</a></div>
    <span class="card-subtitle">{{$post->created_at->format('yy/m/d')}}</span> <br>
    <div class="card-text"><span>{{$post->content}}</span></div>
  </nav>
  @endforeach
      {{$posts->links()}}
</div>
</div>
@endsection
