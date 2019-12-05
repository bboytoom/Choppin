@extends('store.template')

@section('content')
	
	<section class="row justify-content-md-center">
		<div class="col-md-7">
			@include('store.partials.errors')
		</div>

		<div class="col-md-7">
			<div class="card">
				<h5 class="card-header">
					<i class="fas fa-user-check"></i> Crear cuenta
				</h5>

				<div class="card-body">
					<form method="POST" action="/auth/register">
						{!! csrf_field() !!}

						<div class="form-group">
							<label for="name">Nombre</label>
							<input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Nombre">
						</div>

						<div class="form-group">
							<label for="father_surname">Apellido paterno</label>
							<input id="father_surname" class="form-control" type="text" name="father_surname" value="{{ old('father_surname') }}" placeholder="Apellido paterno">
						</div>

						<div class="form-group">
							<label for="mother_surname">Apellido materno</label>
							<input id="mother_surname" class="form-control" type="text" name="mother_surname" value="{{ old('mother_surname') }}" placeholder="Apellido materno">
						</div>

						<div class="form-group">
							<label for="email">Correo electronico</label>
							<input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Correo electronico">
						</div>

						<div class="form-group">
							<label for="password">Contraseña</label>
							<input id="password" class="form-control" type="password" name="password" placeholder="Contraseña">
						</div>

						<div class="form-group">
							<label for="password_confirmation">Confirmar contraseña</label>
							<input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Contraseña">
						</div>

						<div class="form-group text-right mt-4">
							<button type="submit" class="btn btn-dark"> 
								<i class="far fa-file-alt"></i> Registrarme
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

@endsection