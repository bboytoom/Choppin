<template>
  <div id="inicio">
    <indexSlide :photos="photos" />

    <div class="container mt-4">
      <div class="row">
        <indexCategories :categories="categories" />
        <indexProducts :products="products" />
      </div>
    </div>
  </div>
</template>

<script>

import indexSlide from './IndexSlide.vue'
import indexProducts from './IndexProducts.vue'
import indexCategories from './IndexCategories.vue'

export default {
  components: {
    indexSlide,
    indexProducts,
    indexCategories
  },
  data: function () {
    return {
      photos: [],
      products: [],
      categories: []
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function () {
      this.$http.get('/store').then((response) => {
        this.photos = response.data.slide
        this.products = response.data.data
        this.categories = response.data.categories
      })
    }
  }
}

</script>
