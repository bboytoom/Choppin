<template>
  <div id="imageConfiguration" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">
            Logo de la tienda
          </h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="imageConfigurationReset()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <VueFileAgent
          v-model="profilePic"
          class="profile-pic-upload-block"
          :multiple="false"
          :deletable="false"
          :meta="true"
          :compact="true"
          :accept="'image/png, image/jpg, image/jpeg'"
          :thumbnail-size="283"
          :max-size="'1MB'"
          :help-text="'Arrastra la imagen aqui'"
          :error-text="{
            type: 'Archivo no valido',
            size: 'El tamaño maximo es de 1MB ',
          }"
        >
          <template v-slot:after-inner>
            <button title="after-inner" class="btn btn-primary btn-sm btn-block rounded-0">
              <i class="fas fa-upload" /> Selecciona una imagen
            </button>
          </template>

          <template v-slot:after-outer>
            <div title="after-outer" class="modal-footer">
              <button v-if="profilePic" type="button" class="btn btn-secondary" @click="removePic()">
                <span class="icon text-white-50">
                  <i class="fas fa-broom" />
                </span>
                <span class="text">
                  Remover
                </span>
              </button>

              <button type="button" class="btn btn-success btn-icon-split" :class="{'disabled': uploaded || !profilePic}" @click="upload()">
                <span class="icon text-white-50">
                  <i class="fas fa-check" />
                </span>
                <span class="text">
                  Guardar
                </span>
              </button>
            </div>
          </template>
        </VueFileAgent>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    configuration: {
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
    }
  },
  data: function () {
    return {
      profilePic: null,
      uploaded: false
    }
  },
  methods: {
    removePic: function () {
      this.profilePic = null
      this.uploaded = false
    },
    upload: function () {
      var reader = new FileReader()

      if (this.profilePic === null) {
        return false
      }

      reader.onload = (e) => {
        var data = {
          name: this.profilePic.file.name,
          logo: reader.result,
          type: this.profilePic.file.type
        }

        this.$http.put('/configurations/image/' + this.configuration.id, data).then((response) => {
          if (response.status === 200) {
            $('#imageConfiguration').modal('hide')
            this.index(this.state)
            this.imageConfigurationReset()
            this.$toad.toad('La imagen se agrego correctamente')
          }
        })
      }

      reader.readAsDataURL(this.profilePic.file)
    },
    imageConfigurationReset: function () {
      this.configuration.id = 0
      this.configuration.logo.name = ''
      this.configuration.logo.image = ''
      this.configuration.logo.size = 0
      this.profilePic = null
      this.uploaded = false
    }
  }
}

</script>
