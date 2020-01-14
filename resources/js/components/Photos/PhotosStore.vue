<template>
  <div id="createPhoto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formphotocreate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="createPhotoSubmit(photo)">
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

          <modalPhotoForm ref="photoForm" :photo="photo" @imageSelect="imageSelect" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="createPhotoReset()">
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
    modalPhotoForm: modalPhotoForm
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
      imageData: null,
      errorCreate: []
    }
  },
  methods: {
    createPhotoSubmit: function (photo) {
      if (this.imageData !== null) {
        var data = {
          product_id: this.productoid,
          name: photo.name.toLowerCase(),
          image: this.imageData.image,
          type: this.imageData.type,
          base: this.imageData.base,
          description: photo.description.toLowerCase(),
          status: 1
        }

        this.$refs.formphotocreate.validate().then(success => {
          if (!success) {
            return
          }

          this.$http.post('/api/v1/photos/', data).then((response) => {
            if (response.status === 201) {
              $('#createPhoto').modal('hide')

              this.index(this.state)
              this.createPhotoReset()

              this.$toad.toad('La imagen se agrego correctamente')
            }
          })
        })
      } else {
        this.errorCreate = ['Necesita ingresar una imagen']
      }
    },
    createPhotoReset: function () {
      this.photo.id = 0
      this.photo.name = ''
      this.photo.image = ''
      this.photo.url = ''
      this.photo.temp = ''
      this.photo.description = ''
      this.photo.product.name = ''
      this.errorCreate = []
      this.$refs.formphotocreate.reset()
      this.$refs.photoForm.removeFileData()
    },
    imageSelect: function (value) {
      this.imageData = value
    }
  }
}

</script>
