<template>
  <div id="updateConfiguration" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formconfigurationupdate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="updateConfigurationSubmit(configuration)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Editar configuracion
            </h5>
          </div>

          <modalConfigurationForm :configuration="configuration" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="updateConfigurationReset()">
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

import modalConfigurationForm from './ConfigurationsForm.vue'

export default {
  components: {
    modalConfigurationForm
  },
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
    updateConfigurationSubmit: function (configuration) {
      var data = {
        domain: configuration.domain.toLowerCase(),
        name: configuration.name.toLowerCase(),
        business_name: configuration.business_name.toLowerCase(),
        slogan: configuration.slogan.toLowerCase(),
        email: configuration.email.toLowerCase(),
        phone: configuration.phone.toLowerCase(),
        logo: 'logo_default.png',
        status: 1
      }

      this.$refs.formconfigurationupdate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.put('/api/v1/configurations/' + configuration.id, data).then((response) => {
          if (response.status === 200) {
            $('#updateConfiguration').modal('hide')

            this.index(this.state)
            this.updateConfigurationReset()

            this.$toad.toad('La configuracion se actualizo correctamente')
          }
        })
      })
    },
    updateConfigurationReset: function () {
      this.configuration.id = 0
      this.configuration.domain = ''
      this.configuration.name = ''
      this.configuration.business_name = ''
      this.configuration.slogan = ''
      this.configuration.email = ''
      this.configuration.phone = ''
      this.$refs.formconfigurationupdate.reset()
    }
  }
}

</script>
