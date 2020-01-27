<template>
  <div v-if="products.length" class="row">
    <div v-for="item in products" :key="item.id" class="col-md-4 mb-2">
      <div class="card">
        <img :src="`${item.image.url}`" class="card-img-top" :alt="`${item.attributes.name}`">
        <div class="card-body">
          <h5 class="card-title">
            {{ item.attributes.name }}
          </h5>
          <p class="card-text">
            {{ item.attributes.extract }}
          </p>
        </div>
        <div class="card-footer text-center">
          <a href="#" class="btn btn-primary">ver mas</a>
          <button type="button" class="btn btn-primary" @click="addToCart(item)">
            Comprar
          </button>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="row">
    <div class="col-md-12">
      no cuentas con articulos
    </div>
  </div>
</template>

<script>

import { mapMutations } from 'vuex'

export default {
  name: 'IndexProduct',
  props: {
    products: {
      type: Array,
      required: true,
      default: function () {
        return []
      }
    }
  },
  methods: {
    ...mapMutations('cart', ['addProduct']),
    addToCart: function (product) {
      this.addProduct(product)
    }
  }
}

</script>
