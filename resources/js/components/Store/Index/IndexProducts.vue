<template>
  <div class="col-md-9">
    <div class="row">
      <div v-for="item in products" :key="item.id" class="col-md-4 mb-4">
        <div class="card">
          <img class="card-img-top" :src="`${item.image.url}`" :alt="`${item.image.name}`">
          <div class="card-body" style="min-height: 130px;">
            <h5 class="card-title">
              {{ item.attributes.name }}
            </h5>
            <p class="card-text">
              {{ item.attributes.extract }}
            </p>
          </div>

          <div class="card-footer text-center">
            <button class="btn btn-dark" @click="$router.push({ path: `/product/${item.attributes.slug}/${item.id}` })">
              ver mas
            </button>

            <button class="btn btn-dark">
              comprar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    products: {
      type: Array,
      default: function () {
        return []
      }
    }
  }
}

</script>
