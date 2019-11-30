@extends('store.template')

@section('content')
	
	<section class="row">
		<div class="col-md-12 mb-4">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ $categoria->name }}</li>
				</ol>
			</nav>
		</div>

		<div class="col-md-8 text-center">
			<img src="{{ $product->image }}" class="productimg__elem">
		</div>

		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12 border-bottom">
					<h4>
						{{ $product->name }}
					</h4>
				</div>

				<div class="col-md-12 mt-4">
					<h5>
						Precio: ${{ number_format($product->price,2) }} {{ $unidades->contraccion }}
					</h5>
				</div>

				<div class="col-md-12 mt-5">
					<a class="btn btn-dark btn-lg" href="{{ route('cart-add', $product->slug) }}">
						<i class="fas fa-shopping-cart"></i> La quiero
					</a>
				</div>
			</div>
		</div>

		<div class="col-md-12 mt-5">
			<div class="row">
				<div class="col-4">
					<div class="list-group" id="list-tab" role="tablist">
						<a class="list-group-item list-group-item-action list-group-item-dark active" id="list-description-list" data-toggle="list" href="#list-description" role="tab" aria-controls="description">
							Descripcion
						</a>
						<a class="list-group-item list-group-item-action list-group-item-dark" id="list-caracteries-list" data-toggle="list" href="#list-caracteries" role="tab" aria-controls="caracteries">
							Caracteristicas
						</a>
					</div>
				</div>
				<div class="col-8">
					<div class="tab-content mt-3" id="nav-tabContent">
						<div class="tab-pane fade show active" id="list-description" role="tabpanel" aria-labelledby="list-description-list">
							{{ $product->description }}
						</div>
						<div class="tab-pane fade" id="list-caracteries" role="tabpanel" aria-labelledby="list-caracteries-list">
							Caracteristicas del producto
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
@endsection