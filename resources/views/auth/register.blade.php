@extends('store.template')

@section('content')
	<h1>Registrarse</h1>
	
	@include('store.partials.errors')

	<form method="POST" action="/auth/register">
		{!! csrf_field() !!}

		<div>
			<label for="name">Nombre</label>
			<input class="form-control" type="text" name="name" value="{{ old('name') }}">
		</div>

		<div>
			<label for="last_name">Apellidos</label>
			<input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}">
		</div>

		<div>
			<label for="email">Correo</label>
			<input class="form-control" type="email" name="email" value="{{ old('email') }}">
		</div>

		<div>
			<label for="user">Usuario</label>
			<input class="form-control" type="text" name="user" value="{{ old('user') }}">
		</div>

		<div>
			<label for="password">Password</label>
			<input class="form-control" type="password" name="password">
		</div>

		<div>
			<label for="password_confirmation">Confirmar Password</label>
			<input class="form-control" type="password" name="password_confirmation">
		</div>

		<div>
			<label for="adrress">Dirección</label>
			<textarea class="form-control" name="address">{{ old('address') }}</textarea>
		</div>

		<div>
			<button class="btn btn-primary" type="submit">Crear cuenta</button>
		</div>
	</form>

@stop
