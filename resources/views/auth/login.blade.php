@extends('store.template')

@section('content')

	<section class="row">
		<div class="col-md-12">
			@include('store.partials.errors')
		</div>

		<div class="col-md-12">
			<h2>
				Iniciar sesión
			</h2>
	
			<form method="POST" action="/auth/login">
				{!! csrf_field() !!}

				<div class="form-group">
					<label for="email">Correo electronico</label>
					<input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="hola@correo.com">
				</div>

				<div class="form-group">
					<label for="password">Contraseña</label>
					<input id="password" class="form-control" type="password" name="password" placeholder="*******">
				</div>

				<div class="form-group form-check">
					<input id="remember" class="form-check-input" type="checkbox" name="remember"> 
					<label class="form-check-label" for="remember">Recuerdame</label>
				</div>

				<div class="form-group">
					 <button type="submit" class="btn btn-primary">Ingresar</button>
				</div>
			</form>
		</div>
	</section>
			
@endsection