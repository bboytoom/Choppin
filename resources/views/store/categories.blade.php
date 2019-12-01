@extends('store.template')

@section('content')

    <section class="row">

		<div class="col-md-12 mb-4">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ $category_name->name  }}</li>
				</ol>
			</nav>
		</div>

        @include('store.partials.categories')

        <div class="col-md-9">
            <div class="row">
                @foreach ($category_products as $item)
                    <div class="col-md-4 mt-3">
						<div class="card">
							<div class="card-header">
								<h5>
									{{ $item->name }}
								</h5>
							</div>
							<img src="{{ '/products_img/'.$item->image }}" class="card-img-top producstimg__elem" alt="">
							<div class="card-body">
								<h6>
									Precio: <strong>${{ number_format($item->price,2) }}</strong>
								</h6>
								<p class="card-text">
									{{ $item->extract }}
								</p>
							</div>
							<div class="card-footer text-center">
								<a href="{{ route('cart-add', $item->slug) }}" class="btn btn-dark">
									Comprar
								</a>
								<a href="{{ route('product-detail', $item->slug) }}" class="btn btn-dark">
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