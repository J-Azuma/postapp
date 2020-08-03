@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @if (Auth::check())
    <h3 class="col-sm-12">Add Post</h3>
    <div class="card">
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $message)
          <li>{{$message}}</li>
          @endforeach
        </div>
        @endif
        <form action="{{route('posts.create')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="post-title">title</label> <br>
            <input type="text" id="post-title" name="title" value="{{old('title')}}" class="form-control">
          </div>
          <div class="form-group">
            <label for="post-content">content</label> <br>
            <textarea name="content" id="post-content" cols="20" rows="5"
              class="form-control">{{old('content')}}</textarea>
          </div>
          <div class="form-group">
            <input type="file" name="image_path" class="form-control-file">
          </div>
          <button class="btn btn-primary">submit</button>
        </form>
      </div>
    </div>
    @else
    <a href="{{route('login')}}" class="btn btn-primary btn-block">login</a>
    @endif
  </div>
  <hr>
  @if ($posts->isEmpty())
  <p>No result</p>
  @endif
  <div class="col-md-8">
    @foreach ($posts as $post)
    <div class="card">
      <div class="card-header">
        <a href="{{route('users.showdetail', ['user' => App\User::find($post->user_id)])}}">
          {{App\User::find($post->user_id)->name}}</a>
      </div>
      <div class="card-body">
        <div class="card-title"> <a href="{{route('posts.showdetail', ['post' => $post])}}">{{$post->title}}</a></div>
        <div class="card-text">{{$post->content}}</div>
        @if ($post->image_path)
        <div class="card-img"> <img src="{{asset('/storage/post_images/'.$post->image_path)}}"></div>
        Comments : <span>{{$post->comments()->get()->count()}}</span>
        @endif
        <div>
          @if ($post->is_liked_by_auth_user())
          <a href="{{route('posts.unlike', ['post' => $post])}}" class="btn btn-success btn-sm">いいね<span
              class="badge">{{ $post->likes->count() }}</span></a>
          @else
          <a href="{{route('posts.like', ['post' => $post])}}" class="btn btn-secondary btn-sm">いいね<span
              class="badge">{{ $post->likes->count() }}</span></a>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="pagination justify-content">
    {{$posts->links()}}
  </div>
</div>
@endsection
