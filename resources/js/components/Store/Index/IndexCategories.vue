<template>
  <div class="col-md-3">
    <div class="p-3 mb-2 bg-dark text-white">
      Categorias
    </div>
    <ul class="nav flex-column">
      <li v-for="item in categories" :key="item.id" class="nav-item">
        <a class="nav-link" href="#">
          {{ item.name }}
        </a>
      </li>
    </ul>
  </div>
</template>

<script>

export default {
  props: {
    categories: {
      type: Array,
      default: function () {
        return []
      }
    }
  }
}

</script>
