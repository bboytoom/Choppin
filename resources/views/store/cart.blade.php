@extends('store.template')

@section('content')

	<h1>Carrito de compras</h1>
		
	@if(count($cart))

		<a href="{{ route('cart-trash') }}">
			Vaciar carrito 
		</a>
			
		<table>
			<thead>
				<tr>
					<th>Imagen</th>
					<th>Producto</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Subtotal</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cart as $item)
					<tr> 
						<td><img src="{{ $item->image }}"></td>
						<td>{{ $item->name }}</td>
						<td>${{ number_format($item->price,2) }}</td>
						<td>
							<input type="number" min="1" max="100" value="{{ $item->quantity }}" id="product_{{ $item->id }}">
							<a class="btn-update-item" href="#" data-href="{{ route('cart-update', $item->slug) }}" data-id = "{{ $item->id }}">
								actualizar
							</a>
						</td>
						<td>${{ number_format($item->price * $item->quantity,2) }}</td>
						<td>
							<a href="{{ route('cart-delete', $item->slug) }}">
								eliminar
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
				
		<h3>
			Total: ${{ number_format($total,2) }}
		</h3>

	@else
		<h3>No hay productos en el carrito :(</h3>
	@endif
			
		<a href="{{ route('home') }}">
			Seguir comprando
		</a>

		<a href="{{ route('order-detail') }}">
			Continuar
		</a>

@stop