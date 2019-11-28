@extends('store.template')

@section('content')

	<section class="row justify-content-md-center">
		<div class="col-md-12">
			@include('store.partials.errors')
		</div>

		<div class="col-md-7">
			<div class="card">
				<h5 class="card-header">
					<i class="fas fa-user"></i> Iniciar sesión
				</h5>

				<div class="card-body">
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

						<div class="form-group text-right mt-4">
							<button type="submit" class="btn btn-dark">
								<i class="fas fa-sign-in-alt"></i> Ingresar
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
			
@endsection