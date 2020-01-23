<template>
  <div class="col-md-5">
    galeria
  </div>
</template>

<script>

export default {
  name: 'ProductsGallery',
  props: {
    images: {
      type: Array,
      default: function () {
        return []
      }
    }
  }
}

</script>
