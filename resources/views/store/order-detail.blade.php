@extends('store.template')

@section('content')
	

	<h1>Detalle del pedido</h1>


	<h3>Datos del usuario</h3>
		
	<table>
		<tr>
			<td>Nombre:</td><td>{{ Auth::user()->name . " " . Auth::user()->last_name }}</td>
		</tr>
		<tr>
			<td>Usuario:</td><td>{{ Auth::user()->user }}</td>
		</tr>
		<tr>
			<td>Correo:</td><td>{{ Auth::user()->email }}</td>
		</tr>
		<tr>
			<td>Dirección:</td><td>{{ Auth::user()->address }}</td>
		</tr>
	</table>
	
	<h3>Datos del pedido</h3>
	
	<table>
		<tr>
			<th>Producto</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Subtotal</th>
		</tr>
		
		@foreach($cart as $item)
			<tr>
				<td>{{ $item->name }}</td>
				<td>${{ number_format($item->price,2) }}</td>
				<td>{{ $item->quantity }}</td>
				<td>${{ number_format($item->price * $item->quantity,2) }}</td>
			</tr>
		@endforeach
	</table>

		<h3>
			Total: ${{ number_format($total, 2) }}	
		</h3>
	
		<a href="{{ route('cart-show') }}" >
			Regresar
		</a>

		<a href="{{ route('payment') }}" >
			Pagar con paypal
		</a>

@stop