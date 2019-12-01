<nav class="navbar navbar-expand-lg navbar-light bg-light">
	{!! link_to('admin/home', "Dashboard", $attributes = array('class' => 'navbar-brand')) !!}
  
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbaradmin" aria-controls="navbaradmin" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
  
	<div class="collapse navbar-collapse justify-content-end" id="navbaradmin">
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbartienda" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-store"></i> Tienda
				</a>
				<div class="dropdown-menu" aria-labelledby="navbartienda">
					<a class="dropdown-item" href="#">Informacion</a>
					<a class="dropdown-item" href="{{ route('admin.photogallery.index') }}">Galeria</a>
				</div>
			</li>

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbaproductos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-shopping-cart"></i> Productos
				</a>
				<div class="dropdown-menu" aria-labelledby="navbaproductos">
					<a class="dropdown-item" href="{{ route('admin.product.index') }}">Articulos</a>
					<a class="dropdown-item" href="{{ route('admin.category.index') }}">Categorias</a>
				</div>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="{{ route('admin.order.index') }}">
					<i class="fab fa-algolia"></i> Pedidos 
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="{{ route('admin.user.index') }}">
					<i class="fas fa-users"></i> Usuarios
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="{{ route('logout') }}">
					<i class="fas fa-power-off"></i> Salir
				</a>
			</li>
		</ul>
	</div>
</nav>