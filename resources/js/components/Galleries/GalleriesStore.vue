<template>
  <div id="createGallery" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formgallerycreate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="createGallerySubmit(gallery)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Crear galeria
            </h5>
          </div>

          <div v-if="errorCreate.length">
            <div v-for="createerror in errorCreate" :key="createerror" class="alert alert-danger text-center rounded-0" role="alert">
              {{ createerror }}
            </div>
          </div>

          <modalGalleryForm :gallery="gallery" :categories="categories" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="createGalleryReset()">
              <span class="icon text-white-50">
                <i class="fas fa-arrow-left" />
              </span>
              <span class="text">
                Cancelar
              </span>
            </button>

            <button type="submit" class="btn btn-success btn-icon-split" :disabled="invalid">
              <span class="icon text-white-50">
                <i class="fas fa-check" />
              </span>
              <span class="text">
                Guardar
              </span>
            </button>
          </div>
        </form>
      </validation-observer>
    </div>
  </div>
</template>

<script>

import modalGalleryForm from './GalleriesForm.vue'

export default {
  components: {
    modalGalleryForm: modalGalleryForm
  },
  props: {
    gallery: {
      type: Object,
      default: function () {
        return {}
      }
    },
    categories: {
      type: Array,
      default: function () {
        return []
      }
    },
    index: {
      type: Function,
      default: function () {
        return 1
      }
    },
    state: {
      type: Number,
      default: 0
    }
  },
  data: function () {
    return {
      errorCreate: []
    }
  },
  methods: {
    createGallerySubmit: function (gallery) {
      var data = {
        category_id: this.gallery.category.id,
        name: gallery.name.toLowerCase(),
        active: 1,
        status: 1
      }

      this.$refs.formgallerycreate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.post('/api/v1/galleries/', data).then((response) => {
          if (response.status === 201) {
            $('#createGallery').modal('hide')

            this.index(this.state)
            this.createGalleryReset()

            this.$toad.toad('La galeria se agrego correctamente')
          }
        }).catch(error => {
          this.errorCreate = error.response.data.errors.category_id
        })
      })
    },
    createGalleryReset: function () {
      this.gallery.id = 0
      this.gallery.category.id = 0
      this.gallery.name = ''
      this.errorCreate = []
      this.$refs.formgallerycreate.reset()
    }
  }
}

</script>
