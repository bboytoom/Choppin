<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Admin</div>
	</a>

	<li class="nav-item">
    	<a class="nav-link" href="{{ route('user.home') }}">
        	<i class="fas fa-fw fa-tachometer-alt"></i>
        	<span>Dashboard</span>
		</a>
    </li>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<hr class="sidebar-divider">

	<li class="nav-item">
		<a class="nav-link" href="#">
			<i class="fas fa-fw fa-table"></i>
			<span>Pedidos</span>
		</a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Mis datos
	</div>

	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-cog"></i>
			<span>Configuracion</span>
		</a>
		<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="#">Envio</a>
				<a class="collapse-item" href="#">Facturacion</a>
				<a class="collapse-item" href="#">Contacto</a>
			</div>
		</div>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>

<!-- End of Sidebar -->