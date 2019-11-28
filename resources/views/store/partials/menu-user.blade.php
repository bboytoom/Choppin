@if(Auth::check())
	<li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">
            <i class="fas fa-power-off"></i> Salir
        </a>
    </li>
@else
	<li class="nav-item">
            <a class="nav-link" href="{{ route('register-get') }}">
            <i class="far fa-file-alt"></i> Registrarse
        </a>
    </li>

	<li class="nav-item">
            <a class="nav-link" href="{{ route('login-get') }}">
            <i class="fas fa-sign-in-alt"></i> Iniciar sesión
        </a>
    </li>
@endif