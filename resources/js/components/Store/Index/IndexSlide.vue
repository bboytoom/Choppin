<template>
  <vueper-slides lazy lazy-load-on-drag autoplay :touchable="false">
    <vueper-slide v-for="(slide, i) in photos" :key="i" :image="slide.url">
      <template v-slot:loader>
        <i class="fas fa-circle-notch fa-spin" />
        <span>Loading...</span>
      </template>
    </vueper-slide>
  </vueper-slides>
</template>

<script>

import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'

export default {
  components: {
    VueperSlides,
    VueperSlide
  },
  props: {
    photos: {
      type: Array,
      default: function () {
        return []
      }
    }
  },
  data: function () {
    return {

    }
  }
}

</script>
