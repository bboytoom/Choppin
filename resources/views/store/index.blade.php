@extends('store.template')

@section('content')

	@include('store.partials.slider')

	@foreach($products as $product)
		<div class=" ">
			<h3>
				{{ $product->name }}
			</h3>
			<img src="{{ $product->image }}">
			<div class="">
				<p>{{ $product->extract }}</p>
				<h3>
					Precio: ${{ number_format($product->price,2) }}
				</h3>
					
				<a class="" href="{{ route('cart-add', $product->slug) }}">
					La quiero
				</a>
				<a class="" href="{{ route('product-detail', $product->slug) }}">
					Leer mas
				</a>
			</div>
		</div>
	@endforeach
	
@stop