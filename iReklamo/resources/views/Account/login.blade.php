@extends('layouts.app')

@section('title', 'Login')

@section('content')
<h2> Login </h2>
	<form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
		@csrf
		<label>Email Address</label>
		<input type="email" name="email" value="{{ old('email') }}" required>
		@error('email')
			<p style="color:red">{{ $message }} </p>
		@enderror

		<label>Password</label>
		<input type="password" name="password" required>
		@error('password')
			<p style="color:red">{{ $message }} </p>
		@enderror

		<label>Remember me
		<input type="checkbox" name="remember">
		</label>

		<button type="submit">
			Log in
		</button>
	</form>

@endsection