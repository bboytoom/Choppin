<template>
  <div id="updatePhoto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formphotoupdate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="updatePhotoSubmit(photo)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Editar imagen
            </h5>
          </div>

          <modalPhotoForm ref="photoForm" :photo="photo" @imageSelect="imageSelect" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="updatePhotoReset()">
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

import modalPhotoForm from './PhotosForm.vue'

export default {
  components: {
    modalPhotoForm
  },
  props: {
    photo: {
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
    productoid: {
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
    updatePhotoSubmit: function (photo) {
      var data = {}

      if (this.imageData === null) {
        data = {
          product_id: this.productoid,
          name: photo.name.toLowerCase(),
          description: photo.description.toLowerCase(),
          status: 1
        }
      } else {
        data = {
          product_id: this.productoid,
          name: photo.name.toLowerCase(),
          image: this.imageData.image,
          type: this.imageData.type,
          base: this.imageData.base,
          description: photo.description.toLowerCase(),
          status: 1
        }
      }

      this.$refs.formphotoupdate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.put('/api/v1/photos/' + photo.id, data).then((response) => {
          if (response.status === 200) {
            $('#updatePhoto').modal('hide')

            this.index(this.state)
            this.updatePhotoReset()

            this.$toad.toad('La imagen se actualizo correctamente')
          }
        })
      })
    },
    updatePhotoReset: function () {
      this.photo.id = 0
      this.photo.name = ''
      this.photo.image = ''
      this.photo.url = ''
      this.photo.temp = ''
      this.photo.description = ''
      this.photo.product.name = ''
      this.imageData = null
      this.$refs.formphotoupdate.reset()
      this.$refs.photoForm.removeFileData()
    },
    imageSelect: function (value) {
      this.imageData = value
    }
  }
}

</script>
