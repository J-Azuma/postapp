@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <nav class="card">
        <div class="card-header"> Login</div>
        <div class="card-body">
          @if ($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $message)
            {{$message}}
            @endforeach
          </div>
          @endif
          <form action="{{route('login')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="input-email">email</label>
              <input type="text" name="email" id="input-email" class="form-control">
            </div>

            <div class="form-group">
              <label for="input-password">password</label>
              <input type="password" name="password" id="input-password" class="form-control">
            </div>
            <button class="btn btn-primary">login</button>
          </form>
        </div>
        <div class="card-footer">
          <a href="{{route('register')}}">register</a>
        </div>
      </nav>
      test user <br>
      email: test@sample.com <br>
      password: testtest
    </div>
  </div>
</div>
@endsection
