<template>
  <div id="updatePhotoSlide" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formphotoslideupdate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="updatePhotoSlideSubmit(photoslide)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Editar imagen
            </h5>
          </div>

          <modalPhotoSlideForm ref="photoSlideForm" :photoslide="photoslide" @imageSelect="imageSelect" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="updatePhotoSlideReset()">
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
      imageData: null
    }
  },
  methods: {
    updatePhotoSlideSubmit: function (photoslide) {
      var data = {}

      if (this.imageData === null) {
        data = {
          configuration_id: this.slideid,
          name: photoslide.name.toLowerCase(),
          description: photoslide.description.toLowerCase(),
          status: 1
        }
      } else {
        data = {
          configuration_id: this.slideid,
          name: photoslide.name.toLowerCase(),
          image: this.imageData.image,
          type: this.imageData.type,
          base: this.imageData.base,
          description: photoslide.description.toLowerCase(),
          status: 1
        }
      }

      this.$refs.formphotoslideupdate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.put('/api/v1/photoslide/' + photoslide.id, data).then((response) => {
          if (response.status === 200) {
            $('#updatePhotoSlide').modal('hide')

            this.index(this.state)
            this.updatePhotoSlideReset()

            this.$toad.toad('La imagen se actualizo correctamente')
          }
        })
      })
    },
    updatePhotoSlideReset: function () {
      this.photoslide.id = 0
      this.photoslide.name = ''
      this.photoslide.image = ''
      this.photoslide.url = ''
      this.photoslide.temp = ''
      this.photoslide.description = ''
      this.photoslide.configuration.name = ''
      this.imageData = null
      this.$refs.formphotoslideupdate.reset()
      this.$refs.photoSlideForm.removeFileData()
    },
    imageSelect: function (value) {
      this.imageData = value
    }
  }
}

</script>
