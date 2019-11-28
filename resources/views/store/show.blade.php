@extends('store.template')

@section('content')
	
	<section class="row">
		<div class="con-md-4">
			<img src="{{ $product->image }}" class="productimg__elem">
		</div>

		<div class="con-md-4">
			<p>
				{{ $product->name }}
			</p>
			<p>
				Precio: ${{ number_format($product->price,2) }}
			</p>
			<p>
				{{ $product->description }}
			</p>

		</div>

		<div class="con-md-4">
			<a href="{{ route('cart-add', $product->slug) }}">
				La quiero <i class="fa fa-cart-plus fa-2x"></i>
			</a>
		</div>

		<div class="col-md 12">
			<a class="" href="{{ route('home') }}">
				Regresar
			</a>
		</div>
	</section>
	
@endsection