@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <nav class="card">
        <div class="card-header">register</div>
        <div class="card-body">
          @if ($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $message)
            <p>{{$message}}</p>
            @endforeach
          </div>
          @endif
          <form action="{{route('register')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="input-name">name</label>
              <input type="text" name="name" id="input-name" class="form-control" value="{{old('name')}}">
            </div>
            <div class="form-group">
              <label for="input-email">email</label>
              <input type="text" name="email" id="input-email" class="form-control" value="{{old('email')}}">
            </div>
            <div class="form-group">
              <label for="input-password">password</label>
              <input type="password" name="password" id="input-password" class="form-control" value="{{old('password')}}">
            </div>
            <div class="form-group">
              <label for="input-password-confirmation">password(confirmation)</label> <br>
              <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control"> <br>
            </div>
            <button class="btn btn-primary">submit</button>
          </form>
        </div>
        <div class="card-footer">
          <a href="{{route('login')}}">login</a>
        </div>
      </nav>
    </div>
  </div>
</div>
@endsection
