@extends('store.template')

@section('content')
	
	<h1>Detalle del producto</h1>

	<img src="{{ $product->image }}">
	
	<h3>{{ $product->name }}</h3>
	
	{{ $product->description }}
	<h3>
		Precio: ${{ number_format($product->price,2) }}
	</h3>
				
	<a href="{{ route('cart-add', $product->slug) }}">
		La quiero <i class="fa fa-cart-plus fa-2x"></i>
	</a>

	<a class="" href="{{ route('home') }}">
		Regresar
	</a>

@stop