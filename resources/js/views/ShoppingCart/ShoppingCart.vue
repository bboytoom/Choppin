<template>
  <div id="page">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon" />
        </button>
        <div id="navbarNav" class="collapse navbar-collapse justify-content-center">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link :to="{ name: 'home' }" class="nav-link">
                Inicio
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'shopping' }" class="nav-link">
                Carrito
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'contact' }" class="nav-link">
                Contacto
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'authuser' }" class="nav-link">
                login
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <index-cart />

    <router-view />
  </div>
</template>

<script>

import IndexCart from './components/Index/IndexCart'

export default {
  name: 'ShoppingCart',
  components: {
    IndexCart
  }
}

</script>
