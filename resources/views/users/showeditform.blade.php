<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form action="#" method="post">
    name <br>
    <input type="text" name="name" value="{{$user->name}}"> <br>

    email <br>
    <input type="text" name="email" value="{{$user->email}}"> <br>

    profile <br>
    <textarea name="profile"  cols="30" rows="10" >{{$user->profile}}</textarea> <br>

    <button>submit</button>
  </form>
</body>
</html>
