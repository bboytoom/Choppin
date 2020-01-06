<template>
  <div id="createCharacteristic" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formcharacteristiccreate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="createCharacteristicSubmit(characteristic)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Crear caracteristica
            </h5>
          </div>

          <modalCharacteristicForm :characteristic="characteristic" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="createCharacteristicReset()">
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

import modalCharacteristicForm from './CharacteristicsForm.vue'

export default {
  components: {
    modalCharacteristicForm: modalCharacteristicForm
  },
  props: {
    characteristic: {
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
  methods: {
    createCharacteristicSubmit: function (characteristic) {
      var data = {
        product_id: this.productoid,
        name: characteristic.name.toLowerCase(),
        description: characteristic.description.toLowerCase(),
        status: 1
      }

      this.$refs.formcharacteristiccreate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.post('/api/v1/characteristics/', data).then((response) => {
          if (response.status === 201) {
            $('#createCharacteristic').modal('hide')

            this.index(this.state)
            this.createCharacteristicReset()

            this.$toad.toad('La caracteristica se agrego correctamente')
          }
        })
      })
    },
    createCharacteristicReset: function () {
      this.characteristic.id = 0
      this.characteristic.name = ''
      this.characteristic.description = ''
      this.characteristic.product.id = 0
      this.characteristic.product.name = ''
      this.$refs.formcharacteristiccreate.reset()
    }
  }
}

</script>
