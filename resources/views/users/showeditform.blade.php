@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-header">edit profile</div>
        <div class="card-body">
          @if ($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $message)
            {{$message}}
            @endforeach
          </div>
          @endif
          <form action="{{route('users.edit', ['user' => $user])}}" method="post">
            @csrf
            <div class="form-group">
              <label for="name">name</label>
              <input type="text" name="name" value="{{$user->name}}" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">email</label>
              <input type="text" name="email" value="{{$user->email}}" class="form-control">
            </div>
            <div class="form-group">
              <label for="profile">profile</label>
              <textarea name="profile" cols="30" rows="10" class="form-control">{{$user->profile}}</textarea>
            </div>
            <button class="btn btn-primary">submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
