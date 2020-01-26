<template>
  <div id="index" class="container mt-4">
    <div class="row">
      <div class="col-md-3">
        categorias
      </div>
      <div class="col-md-9">
        <index-product :products="products" />
      </div>
    </div>
  </div>
</template>

<script>

import { mapState, mapActions } from 'vuex'
import IndexProduct from './components/Index/IndexProduct'

export default {
  name: 'Index',
  components: {
    IndexProduct
  },
  computed: {
    ...mapState('shop', ['slides', 'categories', 'products'])
  },
  mounted: function () {
    this.productList()
  },
  methods: {
    ...mapActions('shop', ['productList'])
  }
}

</script>
