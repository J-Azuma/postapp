<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <h3>Add Post</h3>
  @if ($errors->any())
    @foreach ($errors->all() as $message)
      <li>{{$message}}</li>
    @endforeach
  @endif
  <form action="{{route('posts.create')}}" method="post">
    @csrf
    <label for="post-title">title</label> <br>
    <input type="text" id="post-title" name="title" value="{{old('title')}}"> <br>
    <label for="post-content">content</label> <br>
    <textarea name="content" id="post-content" cols="20" rows="10" >{{old('content')}}</textarea> <br>
    <button>submit</button>
  </form>
</body>

</html>
