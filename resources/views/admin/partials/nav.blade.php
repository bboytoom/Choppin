<nav class="navbar navbar-expand-lg navbar-light bg-light">
	{!! link_to('admin/home', "Dashboard", $attributes = array('class' => 'navbar-brand')) !!}
  
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbaradmin" aria-controls="navbaradmin" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
  
	<div class="collapse navbar-collapse justify-content-end" id="navbaradmin">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('admin.category.index') }}">
					<i class="fas fa-list-alt"></i> Categorias
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('admin.product.index') }}">
					<i class="fas fa-shopping-cart"></i> Productos
				</a>
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