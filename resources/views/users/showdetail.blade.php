<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  name: {{$user->name}} <br>
  register date :{{$user->created_at->format('yy/m/d')}} <br>
  profile : {{$user->profile}} <br>

  @if (Auth::check() && Auth::user()->id == $user->id)
  <a href="{{route('users.showeditform', ['user' => $user])}}">登録情報を編集する</a>
  @endif
</body>
</html>
