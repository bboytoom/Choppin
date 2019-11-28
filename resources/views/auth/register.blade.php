@extends('store.template')

@section('content')
	
	<section class="row">
		<div class="col-md-12">
			@include('store.partials.errors')
		</div>

		<div class="col-md-12">
			<h2>
				Registrarse
			</h2>

			<form method="POST" action="/auth/register">
				{!! csrf_field() !!}

				<div class="form-group">
					<label for="name">Nombre</label>
					<input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Nombre">
				</div>

				<div class="form-group">
					<label for="last_name">Apellidos</label>
					<input id="last_name" class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Apellidos">
				</div>

				<div class="form-group">
					<label for="email">Correo electronico</label>
					<input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Correo electronico">
				</div>

				<div class="form-group">
					<label for="user">Usuario</label>
					<input id="user" class="form-control" type="text" name="user" value="{{ old('user') }}" placeholder="Usuario">
				</div>

				<div class="form-group">
					<label for="password">Contraseña</label>
					<input id="password" class="form-control" type="password" name="password" placeholder="Contraseña">
				</div>

				<div class="form-group">
					<label for="password_confirmation">Confirmar contraseña</label>
					<input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Contraseña">
				</div>

				<div class="form-group">
					<label for="adrress">Dirección</label>
					<textarea id="adrress" class="form-control" name="address" placeholder="Direccion">
						{{ old('address') }}
					</textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Registrarme</button>
				</div>
			</form>
		</div>
	</section>

@endsection