@extends('store.template')

@section('content')
	
	<section class="row mt-4">
		<div class="col-md-12">
			<h2>
				Detalle del pedido
			</h2>
		</div>

		<div class="col-md-6 mt-4">
			<div class="card">
				<div class="card-header">
					Datos del usuario
				</div>

				<div class="card-body">
					<table class="table table-striped">
						<tbody>
							<tr>
								<td>Nombre:</td>
								<td>{{ Auth::user()->name . " " . Auth::user()->last_name }}</td>
							</tr>
							<tr>
								<td>Usuario:</td>
								<td>{{ Auth::user()->user }}</td>
							</tr>
							<tr>
								<td>Correo:</td>
								<td>{{ Auth::user()->email }}</td>
							</tr>
							<tr>
								<td>Dirección:</td>
								<td>{{ Auth::user()->address }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="col-md-12 mt-5">
			<h4>
				Datos del pedido
			</h4>

			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Producto</th>
						<th class="text-center" scope="col">Precio</th>
						<th class="text-center" scope="col">Cantidad</th>
						<th class="text-center" scope="col">Subtotal</th>
					</tr>
				</thead>

				<tbody>
					@foreach($cart as $item)
						<tr>
							<td>{{ $item->name }}</td>
							<td class="text-center">${{ number_format($item->price,2) }}</td>
							<td class="text-center">{{ $item->quantity }}</td>
							<td class="text-center">${{ number_format($item->price * $item->quantity,2) }}</td>
						</tr>
					@endforeach

					<tr>
						<td></td>
						<td class="text-center">
							<a class="text-dark" href="{{ route('cart-show') }}" >
								<i class="fas fa-undo-alt fa-2x"></i>
							</a>
						</td>
						<td class="text-center">
							<a class="text-dark" href="{{ route('payment') }}">
								<i class="fab fa-cc-paypal fa-2x"></i>
							</a>
						</td>
						<td class="text-center">
							<strong>$ {{ number_format($total,2) }}</strong>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>

@endsection