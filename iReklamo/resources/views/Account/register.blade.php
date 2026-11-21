@extends('layouts.app')


@section('title','Register')

@section('content')
	
	<h2>Register Form</h2>

	<form action="{{ route('Register.submit') }}" method="POST" class="space-y-4 center">

		<label class="text-sm"> 
			<input type="name" name="name" required>
			@error('name')
				<p style="color:red"> {{ $message }} </p>
			@enderror 
		</label>

		<label class="text-sm"> 
			<input type="email" name="email" required>
			@error('email')
				<p style="color:red"> {{ $message }} </p>
			@enderror 
		</label>

		<label class="text-sm"> 
			<input type="password" name="password" required>
			@error('password')
				<p style="color:red"> {{ $message }} </p>
			@enderror 
		</label>

		<label class="text-sm"> 
			<input type="password" name="password_confirmation">
		</label>


		<label class="text-sm">
			<button>Sign up</button>

		</label>

	</form>

@endsection
