<template>
  <div id="createPhotoGallery" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formphotogallerycreate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="createPhotoGallerySubmit(photogallery)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Crear imagen
            </h5>
          </div>

          <div v-if="errorCreate.length">
            <div v-for="createerror in errorCreate" :key="createerror" class="alert alert-danger text-center rounded-0" role="alert">
              {{ createerror }}
            </div>
          </div>

          <modalPhotoGalleryForm ref="photoGalleryForm" :photogallery="photogallery" @imageSelect="imageSelect" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="createPhotoGalleryReset()">
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

import modalPhotoGalleryForm from './PhotoGalleryForm.vue'

export default {
  components: {
    modalPhotoGalleryForm: modalPhotoGalleryForm
  },
  props: {
    photogallery: {
      type: Object,
      default: function () {
        return {}
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
    },
    galleryid: {
      type: Number,
      default: 0
    }
  },
  data: function () {
    return {
      imageData: null,
      errorCreate: []
    }
  },
  methods: {
    createPhotoGallerySubmit: function (photogallery) {
      if (this.imageData !== null) {
        var data = {
          gallery_id: this.galleryid,
          name: photogallery.name.toLowerCase(),
          image: this.imageData.image,
          type: this.imageData.type,
          base: this.imageData.base,
          description: photogallery.description.toLowerCase(),
          status: 1
        }

        this.$refs.formphotogallerycreate.validate().then(success => {
          if (!success) {
            return
          }

          this.$http.post('/api/v1/photosgalleries/', data).then((response) => {
            if (response.status === 201) {
              $('#createPhotoGallery').modal('hide')

              this.index(this.state)
              this.createPhotoGalleryReset()

              this.$toad.toad('La imagen se agrego correctamente')
            }
          })
        })
      } else {
        this.errorCreate = ['Necesita ingresar una imagen']
      }
    },
    createPhotoGalleryReset: function () {
      this.photogallery.id = 0
      this.photogallery.name = ''
      this.photogallery.image = ''
      this.photogallery.url = ''
      this.photogallery.temp = ''
      this.photogallery.description = ''
      this.photogallery.gallery.name = ''
      this.errorCreate = []
      this.imageData = null
      this.$refs.formphotogallerycreate.reset()
      this.$refs.photoGalleryForm.removeFileData()
    },
    imageSelect: function (value) {
      this.imageData = value
    }
  }
}

</script>
