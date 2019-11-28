@extends('store.template')

@section('content')

	<section class="row">
		<div class="col-md-12">
			@include('store.partials.errors')
		</div>

		<div class="col-md-12">
			<h2>
				Carrito de compras
			</h2>
		</div>

		<div class="col-md-12">
			@if(count($cart))

				<a href="{{ route('cart-trash') }}">
					Vaciar carrito 
				</a>
					
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Imagen</th>
							<th scope="col">Producto</th>
							<th scope="col">Precio</th>
							<th scope="col">Cantidad</th>
							<th scope="col">Subtotal</th>
							<th scope="col">Quitar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cart as $item)
							<tr> 
								<td><img src="{{ $item->image }}" class="imgcarrito__elem"></td>
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
						
				<h4>
					Total: ${{ number_format($total,2) }}
				</h4>
			@else
				<h3>No hay productos en el carrito :(</h3>
			@endif
		</div>

		<div class="col-md-12">
			<a href="{{ route('home') }}">
				Seguir comprando
			</a>

			<a href="{{ route('order-detail') }}">
				Continuar
			</a>
		</div>
	</section>

@endsection