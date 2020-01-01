<template>
  <div id="createShipping" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formshippingcreate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="createShippingSubmit(shipping)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Crear direccion
            </h5>
          </div>

          <modalShippingForm :shipping="shipping" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="createShippingReset()">
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

import modalShippingForm from './ShippingsForm.vue'
import axios from 'axios'
import { ToadAlert } from '../helpers'

export default {
  components: {
    modalShippingForm: modalShippingForm
  },
  props: {
    shipping: {
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
    userid: {
      type: Number,
      default: 0
    }
  },
  methods: {
    createShippingSubmit: function (shipping) {
      var data = {
        user_id: this.userid,
        street_one: shipping.street_one.toLowerCase(),
        street_two: shipping.street_two.toLowerCase(),
        addres: shipping.addres.toLowerCase(),
        suburb: shipping.suburb.toLowerCase(),
        town: shipping.town.toLowerCase(),
        state: shipping.state.toLowerCase(),
        country: shipping.country.toLowerCase(),
        postal_code: shipping.postal_code,
        status: 1
      }

      this.$refs.formshippingcreate.validate().then(success => {
        if (!success) {
          return
        }

        axios.post('/api/v1/shippings/', data).then((response) => {
          if (response.status === 201) {
            $('#createShipping').modal('hide')

            this.index(this.state)
            this.createShippingReset()

            ToadAlert.toad('La direccion se agrego correctamente')
          }
        })
      })
    },
    createShippingReset: function () {
      this.shipping.id = 0
      this.shipping.street_one = ''
      this.shipping.street_two = ''
      this.shipping.addres = ''
      this.shipping.suburb = ''
      this.shipping.town = ''
      this.shipping.state = ''
      this.shipping.country = ''
      this.shipping.postal_code = ''
      this.shipping.user.id = 0
      this.shipping.user.name = ''
      this.$refs.formshippingcreate.reset()
    }
  }
}

</script>
