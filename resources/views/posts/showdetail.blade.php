@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-6">
      <nav class="card">
        <div class="card-header"><span>{{$post->title}}</span></div>
        <div class="card-body">
          <div class="card-title">{{App\User::find($post->user_id)->name}}</div>
          <h6 class="card-subtitle">{{$post->created_at->format('yy/m/d')}}</h6>
          <div class="card-text">
            {{$post->content}}
          </div>
        </div>
        @if (Auth::check() && Auth::user()->id == $post->user_id)
        <div class="card-footer">
          <form action="{{route('posts.delete', ['post' => $post])}}" method="post">
            @csrf
            <button>delete</button>
          </form>
        </div>
        @endif
      </nav>
    </div>
  </div>
  comments : {{$post->comments()->count()}}
  <div class="col-4">
    @foreach ($post->comments()->get()->sortByDesc('created_at') as $comment)
    <nav class="card">
      <div class="card-body">
        <div class="card-subtitle">{{App\User::find($comment->user_id)->name}}</div>
        {{$comment->created_at->format('yy/m/d G:i:s')}}
        <div class="card-text">{{$comment->content}}</div>
      </div>
    </nav>
    @endforeach
  </div>

  @if (Auth::check() && $post->user_id != Auth::user()->id)
  <hr>
  <div class="col-4">
    <nav class="card">
      <div class="card-header">Add Comment</div>
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $message)
          {{$message}}
          @endforeach
        </div>
        @endif
        <form action="{{route('comments.create', ['post' => $post])}}" method="post">
          @csrf
          <div class="form-group">
            <label for="comment">content</label>
            <textarea name="content" id="comment" cols="5" rows="5" class="form-control">{{old('content')}}</textarea>
          </div>
          <button class="btn btn-primary">submit</button>
          @endif
        </form>
      </div>
    </nav>
  </div>
</div>
@endsection
