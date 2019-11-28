@extends('store.template')

@section('content')
	
	<section class="row">
		
		@include('store.partials.categories')

		<div class="col-md-9">
			<div class="row">
				@foreach($products as $product)
					<div class="col-md-4 mt-3">
						<div class="card">
							<div class="card-header">
								<h5>
									{{ $product->name }}
								</h5>
							</div>
							<img src="{{ $product->image }}" class="card-img-top producstimg__elem" alt="">
							<div class="card-body">
								<h6>
									Precio: <strong>${{ number_format($product->price,2) }}</strong>
								</h6>
								<p class="card-text">
									{{ $product->extract }}
								</p>
							</div>
							<div class="card-footer text-center">
								<a href="{{ route('cart-add', $product->slug) }}" class="btn btn-dark">
									Comprar
								</a>
								<a href="{{ route('product-detail', $product->slug) }}" class="btn btn-dark">
									Leer más
								</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>

@endsection