<nav>
    <a href="{{ route('home') }}">logo</a>

    <a href="{{ route('cart-show') }}">
          carrito
    </a>
       
    @include('store.partials.menu-user')
</nav>