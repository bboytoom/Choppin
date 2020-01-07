<template>
  <div id="imageConfiguration" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formconfigurationimage">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="imageConfigurationSubmit(configuration)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Logo del carrito
            </h5>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                s
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="imageConfigurationReset()">
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
  methods: {
    imageConfigurationSubmit: function (configuration) {
      var data = {
        name: configuration.name,
        image: configuration.image
      }

      this.$refs.formconfigurationupdate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.put('/api/v1/configurations/image/' + configuration.id, data).then((response) => {
          if (response.status === 200) {
            $('#imageConfiguration').modal('hide')

            this.index(this.state)
            this.imageConfigurationReset()

            this.$toad.toad('La imagen se agrego correctamente')
          }
        })
      })
    },
    imageConfigurationReset: function () {
      this.configuration.id = 0
      this.configuration.logo.name = ''
      this.configuration.logo.image = ''
      this.$refs.formconfigurationimage.reset()
    }
  }
}

</script>
