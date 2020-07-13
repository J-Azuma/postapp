@extends('layouts.app')

@section('content')
  name: {{$user->name}} <br>
  register date :{{$user->created_at->format('yy/m/d')}} <br>
  profile : {{$user->profile}} <br>

  @if (Auth::check() && Auth::user()->id == $user->id)
  <a href="{{route('users.showeditform', ['user' => $user])}}">登録情報を編集する</a>
  @endif
@endsection
