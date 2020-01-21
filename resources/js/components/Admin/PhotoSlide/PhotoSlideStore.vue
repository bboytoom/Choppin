<template>
  <div id="createPhotoSlide" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formphotoslidecreate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="createPhotoSlideSubmit(photoslide)">
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

          <modalPhotoSlideForm ref="photoSlideForm" :photoslide="photoslide" @imageSelect="imageSelect" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="createPhotoSlideReset()">
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

import modalPhotoSlideForm from './PhotoSlideForm.vue'

export default {
  components: {
    modalPhotoSlideForm
  },
  props: {
    photoslide: {
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
    slideid: {
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
    createPhotoSlideSubmit: function (photoslide) {
      if (this.imageData !== null) {
        var data = {
          configuration_id: this.slideid,
          name: photoslide.name.toLowerCase(),
          image: this.imageData.image,
          type: this.imageData.type,
          base: this.imageData.base,
          description: photoslide.description.toLowerCase(),
          status: 1
        }

        this.$refs.formphotoslidecreate.validate().then(success => {
          if (!success) {
            return
          }

          this.$http.post('/api/v1/photoslide/', data).then((response) => {
            if (response.status === 201) {
              $('#createPhotoSlide').modal('hide')

              this.index(this.state)
              this.createPhotoSlideReset()

              this.$toad.toad('La imagen se agrego correctamente')
            }
          })
        })
      }
    },
    createPhotoSlideReset: function () {
      this.photoslide.id = 0
      this.photoslide.name = ''
      this.photoslide.image = ''
      this.photoslide.url = ''
      this.photoslide.temp = ''
      this.photoslide.description = ''
      this.photoslide.configuration.name = ''
      this.errorCreate = []
      this.imageData = null
      this.$refs.formphotoslidecreate.reset()
      this.$refs.photoSlideForm.removeFileData()
    },
    imageSelect: function (value) {
      this.imageData = value
    }
  }
}

</script>
