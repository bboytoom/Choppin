@extends('store.template')

@section('content')

	<section class="row mt-4">
		<div class="col-md-12">
			@include('store.partials.errors')
		</div>

		<div class="col-md-12">
			<h2>
				Carrito de compras
			</h2>
		</div>

		<div class="col-md-12 mt-4">
			@if(count($cart))

				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col">Producto</th>
							<th scope="col">Precio</th>
							<th scope="col">Cantidad</th>
							<th class="text-center" scope="col">Subtotal</th>
							<th class="text-center" scope="col">
								<a class="text-dark" href="{{ route('cart-trash') }}">
									Borrar todo <i class="fas fa-sad-cry"></i>
								</a>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cart as $item)
							<tr> 
								<td><img src="{{ '/products_img/'.$item->image }}" class="imgcarrito__elem"></td>
								<td>{{ $item->name }}</td>
								<td>${{ number_format($item->price,2) }}</td>
								<td>
									<input type="number" min="1" max="100" value="{{ $item->quantity }}" id="product_{{ $item->id }}">
									<br>
									<a class="btn-update-item" href="#" data-href="{{ route('cart-update', $item->slug) }}" data-id = "{{ $item->id }}">
										actualizar
									</a>
								</td>
								<td class="text-center">${{ number_format($item->price * $item->quantity,2) }}</td>
								<td class="text-center">
									<a class="text-dark" href="{{ route('cart-delete', $item->slug) }}">
										<i class="fas fa-trash-alt fa-2x"></i>
									</a>
								</td>
							</tr>
						@endforeach
						
						<tr>
							<td></td>
							<td></td>
							
							<td>
								<a class="text-dark" href="{{ route('home') }}">
									<i class="fas fa-undo-alt fa-2x"></i>
								</a>
							</td>
							<td>
								<a class="text-dark" href="{{ route('order-detail') }}">
									<i class="far fa-credit-card fa-2x"></i>
								</a>
							</td>
							
							<td class="text-center">
								<strong>$ {{ number_format($total,2) }}</strong>
							</td>
							<td></td>
						</tr>
					</tbody>
				</table>
						
				<h4>
					
				</h4>
			@else
				<div class="col-md-12 text-center mt-5">
					<h3>
						No hay productos en el carrito <i class="fas fa-sad-cry"></i>
					</h3>

					<a class="btn btn-dark btn-lg mt-3" href="{{ route('home') }}">
						Encontrar articulos
					</a>
				</div>
			@endif
		</div>
	</section>

@endsection