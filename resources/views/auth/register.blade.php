@extends('layouts.app')

@section('content')

@if ($errors->any())
@foreach ($errors->all() as $message)
<p>{{$message}}</p>
@endforeach
@endif
<form action="{{route('register')}}" method="post">
  @csrf
  <label for="input-name">name</label> <br>
  <input type="text" name="name" id="input-name"> <br>

  <label for="input-email">email</label> <br>
  <input type="text" name="email" id="input-email"> <br>

  <label for="input-password">password</label> <br>
  <input type="password" name="password" id="input-password"> <br>

  <label for="input-password-confirmation">password(confirmation)</label> <br>
  <input type="password" name="password_confirmation" id="input-password-confirmation"> <br>

  <button>submit</button>
</form>
@endsection
