<template>
  <div id="producto_show" class="container mt-4">
    <div class="row">
      <div class="col-md-5">
        galeria
      </div>

      <productsDescription :product="product" />
      <productsCharacteristic :description="description" />
    </div>
  </div>
</template>

<script>

import productsDescription from './ProductsDescription.vue'
import productsCharacteristic from './ProductsCharacteristic.vue'

export default {
  name: 'ProductShow',
  components: {
    productsDescription,
    productsCharacteristic
  },
  data: function () {
    return {
      product: {
        id: 0,
        name: '',
        extract: '',
        price: ''
      },
      description: ''
    }
  },
  created: function () {
    this.$http.get('/store/' + this.$route.params.id).then((response) => {
      this.product.id = response.data.id
      this.product.name = response.data.attributes.name
      this.product.extract = response.data.attributes.extract
      this.product.price = response.data.attributes.price
      this.description = response.data.attributes.description
    })
  }
}

</script>
