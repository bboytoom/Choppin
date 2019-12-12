<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Inicio 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-shopping-basket"></i> Mi carrito
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-mail-bulk"></i> Contacto
                    </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                
                @if(Auth::check())
                    
                    @if (Auth::guard('web')->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.home') }}">
                                <i class="fas fa-user"></i> Mi perfil
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.logout') }}">
                                <i class="fas fa-power-off"></i> Salir
                            </a>
                        </li>
                    @endif

                    @if (Auth::guard('admin')->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.home') }}">
                                <i class="fas fa-user"></i> Mi perfil
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.logout') }}">
                                <i class="fas fa-power-off"></i> Salir
                            </a>
                        </li>
                    @endif

                @else
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-file-alt"></i> Registrarse
                        </a>
                    </li>

                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>