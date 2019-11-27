@if(Auth::check())
	<a href="{{ route('logout') }}">Finalizar sesión</a>
@else
	<a href="{{ route('login-get') }}">Iniciar sesión</a>
	<a href="{{ route('register-get') }}">Registrarse</a>
@endif