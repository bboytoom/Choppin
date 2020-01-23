<template>
  <div class="col-md-12 mt-5">
    caracteristicas del producto
  </div>
</template>

<script>

export default {
  name: 'ProductsCharacteristic',
  props: {
    product: {
      type: Object,
      default: function () {
        return {}
      }
    }
  }
}

</script>
