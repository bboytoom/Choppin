@extends('store.template')

@section('content')
	
	<section class="row">
		<div class="col-md-12">
			<h2>
				Detalle del pedido
			</h2>
		</div>

		<div class="col-md-12">
			<h3>
				Datos del usuario
			</h3>

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

		<div class="col-md-12">
			<h3>
				Datos del pedido
			</h3>

			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Producto</th>
						<th scope="col">Precio</th>
						<th scope="col">Cantidad</th>
						<th scope="col">Subtotal</th>
					</tr>
				</thead>

				<tbody>
					@foreach($cart as $item)
						<tr>
							<td>{{ $item->name }}</td>
							<td>${{ number_format($item->price,2) }}</td>
							<td>{{ $item->quantity }}</td>
							<td>${{ number_format($item->price * $item->quantity,2) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<h3>
				Total: ${{ number_format($total, 2) }}	
			</h3>
		</div>

		<div class="col-md-12">
			<a href="{{ route('cart-show') }}" >
				Regresar
			</a>

			<a href="{{ route('payment') }}" >
				Pagar con paypal
			</a>
		</div>
	</section>

@endsection