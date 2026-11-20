@extends('layouts.app')

@section('content')

<h1>Signup</h1>
<h2>Enter your information below</h2>

<form method="POST" action="/credentials">
	@csrf

	<label>Enter your Name: <input type="text" name="name"></label>
	@error('name')
		<p style="color:red">{{ $message }}</p>
	@enderror

	<label>Enter your Email: <input type="email" name="email"></label>
	@error('email')
		<p style="color:red">{{ $message }}</p>
	@enderror

	<label>Enter your Password: <input type="password" name="password" minlength="8"></label>
	@error('password')
		<p style="color:red">{{ $message }}</p>
	@enderror

	<label>Confirm Password: <input type="password" name="password_confirmation" minlength="8"></label>

	<button type="submit">Signup</button>
</form>
@endsection