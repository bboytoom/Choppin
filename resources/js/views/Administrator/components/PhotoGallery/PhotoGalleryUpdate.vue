<template>
  <div id="updatePhotoGallery" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formphotogalleryupdate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="updatePhotoGallerySubmit(photogallery)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Editar imagen
            </h5>
          </div>

          <modalPhotoGalleryForm ref="photoGalleryForm" :photogallery="photogallery" @imageSelect="imageSelect" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="updatePhotoGalleryReset()">
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
    modalPhotoGalleryForm
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
      imageData: null
    }
  },
  methods: {
    updatePhotoGallerySubmit: function (photogallery) {
      var data = {}

      if (this.imageData === null) {
        data = {
          gallery_id: this.galleryid,
          name: photogallery.name.toLowerCase(),
          description: photogallery.description.toLowerCase(),
          status: 1
        }
      } else {
        data = {
          gallery_id: this.galleryid,
          name: photogallery.name.toLowerCase(),
          image: this.imageData.image,
          type: this.imageData.type,
          base: this.imageData.base,
          description: photogallery.description.toLowerCase(),
          status: 1
        }
      }

      this.$refs.formphotogalleryupdate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.put('/photosgalleries/' + photogallery.id, data).then((response) => {
          if (response.status === 200) {
            $('#updatePhotoGallery').modal('hide')

            this.index(this.state)
            this.updatePhotoGalleryReset()

            this.$toad.toad('La imagen se actualizo correctamente')
          }
        })
      })
    },
    updatePhotoGalleryReset: function () {
      this.photogallery.id = 0
      this.photogallery.name = ''
      this.photogallery.image = ''
      this.photogallery.url = ''
      this.photogallery.temp = ''
      this.photogallery.description = ''
      this.photogallery.gallery.name = ''
      this.imageData = null
      this.$refs.formphotogalleryupdate.reset()
      this.$refs.photoGalleryForm.removeFileData()
    },
    imageSelect: function (value) {
      this.imageData = value
    }
  }
}

</script>
