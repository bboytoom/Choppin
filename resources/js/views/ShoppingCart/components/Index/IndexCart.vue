<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <div class="btn-group">
        <button id="dropdownMenu2" class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ totalProducts }} articulos
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <div class="row">
            <div v-if="cart.length" class="col-md-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">
                      qty
                    </th>
                    <th scope="col">
                      Nombre
                    </th>
                    <th scope="col">
                      precio
                    </th>
                    <th scope="col">
                      image
                    </th>
                    <th scope="col">
                      eliminar
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in cart" :key="item.id">
                    <th>
                      {{ item.qty }}
                    </th>
                    <td scope="row">
                      {{ item.attributes.name }}
                    </td>
                    <td>
                      $ {{ item.attributes.price }}
                    </td>
                    <td>
                      <img :src="`${item.image.url}`" class="card-img-top" :alt="`${item.attributes.name}`" width="64px">
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger" @click.prevent="removeProductFromCart(item)">
                        Elimnar
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>

              <div class="alert alert-primary" role="alert">
                total: {{ totalCost }}
              </div>
            </div>

            <div v-else class="col-md-12">
              <div class="alert alert-primary" role="alert">
                No cuenta con productos
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>

import { mapState, mapMutations, mapGetters } from 'vuex'

export default {
  name: 'IndexCart',
  computed: {
    ...mapState('cart', ['cart']),
    ...mapGetters('cart', ['totalCost', 'totalProducts'])
  },
  methods: {
    ...mapMutations('cart', ['removeProductFromCart'])
  }
}

</script>
