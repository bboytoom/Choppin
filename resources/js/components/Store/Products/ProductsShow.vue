<template>
  <div id="producto_show" class="container mt-4">
    <div class="row">
      <productsGallery :images="images" />
      <productsDescription :product="product" />
      <productsCharacteristic :description="description" />
    </div>
  </div>
</template>

<script>

import productsGallery from './ProductsGallery.vue'
import productsDescription from './ProductsDescription.vue'
import productsCharacteristic from './ProductsCharacteristic.vue'

export default {
  name: 'ProductShow',
  components: {
    productsGallery,
    productsDescription,
    productsCharacteristic
  },
  data: function () {
    return {
      images: [],
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
      this.images = response.data.images
      this.product.id = response.data.id
      this.product.name = response.data.attributes.name
      this.product.extract = response.data.attributes.extract
      this.product.price = response.data.attributes.price
      this.description = response.data.attributes.description
    })
  }
}

</script>
