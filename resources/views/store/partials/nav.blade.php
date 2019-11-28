<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">Logo</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-home"></i> Inicio 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart-show') }}">
                    <i class="fas fa-shopping-basket"></i> Mi carrito
                </a>
            </li>

            @if(Auth::check())
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">
                        <i class="fas fa-power-off"></i> Salir
                    </a>
                </li>
            @else
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-get') }}">
                        <i class="fas fa-file-alt"></i> Registrarse
                    </a>
                </li>

                <li class="nav-item">
                        <a class="nav-link" href="{{ route('login-get') }}">
                        <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>