@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			@if ($errors->any())
			  @foreach ($errors->all() as $message)
			    {{$message}}
			  @endforeach
			@endif
			<form action="{{route('login')}}" method="post">
				@csrf
				<label for="input-email">email</label> <br>
				<input type="text" name="email" id="input-email"> <br>

				<label for="input-password">password</label> <br>
        <input type="password" name="password" id="input-password"> <br> <br>

        <button>login</button>
			</form>
		</div>
	</div>
</div>
@endsection
