<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  @if ($errors->any())
  @foreach ($errors->all() as $message)
  <li>{{$message}}</li>
  @endforeach
  @endif
  <form action="{{route('users.edit', ['user' => $user])}}" method="post">
    @csrf
    name <br>
    <input type="text" name="name" value="{{$user->name}}"> <br>

    email <br>
    <input type="text" name="email" value="{{$user->email}}"> <br>

    profile <br>
    <textarea name="profile" cols="30" rows="10">{{$user->profile}}</textarea> <br>

    <button>submit</button>
  </form>
</body>

</html>
