<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3 text-right">
      <div class="row">
        <div class="col-md-6">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fas fa-search" />
              </div>
            </div>
            <input v-model="searchShippings" type="text" class="form-control" placeholder="Busca la direccion">
          </div>
        </div>

        <div class="col-md-6">
          <button type="button" class="btn btn-primary btn-icon-split btn-sm" @click.prevent="create()">
            <span class="icon text-white-50">
              <i class="fa fa-plus-circle" />
            </span>
            <span class="text">Agregar</span>
          </button>
        </div>
      </div>
    </div>

    <div class="card-body">
      <h4 v-if="shippings.length == 0" class="text-center">
        No cuentas con ninguna direccion
      </h4>

      <div v-else class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Calle</th>
              <th>Direccion</th>
              <th>Colonia</th>
              <th class="text-center" width="100">
                Estado
              </th>
              <th class="text-center" width="110">
                Editar
              </th>
              <th class="text-center" width="110">
                Eliminar
              </th>
            </tr>
          </thead>

          <tableShipping
            :index="index"
            :shippings="filtroShipping"
            :userid="userid"
            :state="page_state"
            @dataEdit="dataEdit"
          />
        </table>

        <paginate
          :page-count="number_page"
          :prev-text="'Anterior'"
          :next-text="'Siguiente'"
          :container-class="'pagination'"
          :page-class="'page-item'"
          :page-link-class="'page-link'"
          :next-class="'page-item'"
          :next-link-class="'page-link'"
          :prev-class="'page-item'"
          :prev-link-class="'page-link'"
          :click-handler="index"
        />
      </div>
    </div>

    <storeShipping
      :shipping="shipping"
      :userid="userid"
      :index="index"
      :state="page_state"
    />
    <updateShipping
      :shipping="shipping"
      :userid="userid"
      :index="index"
      :state="page_state"
    />
  </div>
</template>

<script>

import tableShipping from './ShipingsTable.vue'
import updateShipping from './ShippingsUpdate.vue'
import storeShipping from './ShippingsStore.vue'

export default {
  components: {
    tableShipping,
    updateShipping,
    storeShipping
  },
  props: {
    userid: {
      type: Number,
      default: 0
    }
  },
  data: function () {
    return {
      shippings: [],
      number_page: 0,
      page_state: 1,
      searchShippings: '',
      shipping: {
        id: 0,
        street_one: '',
        street_two: '',
        addres: '',
        suburb: '',
        town: '',
        state: '',
        country: '',
        postal_code: '',
        user: {
          id: 0,
          name: ''
        }
      }
    }
  },
  computed: {
    filtroShipping: function () {
      if (this.searchShippings) {
        return this.shippings.filter((item) => {
          return item.attributes.suburb.includes(this.searchShippings)
        })
      } else {
        return this.shippings
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      this.$http.get('/api/v1/shippings/all/' + this.userid + '?page=' + page).then((response) => {
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.shippings = response.data.data
      })
    },
    create: function () {
      $('#createShipping').modal('show')
    },
    dataEdit: function (value) {
      this.shipping.id = value.id
      this.shipping.street_one = value.street_one
      this.shipping.street_two = value.street_two
      this.shipping.addres = value.addres
      this.shipping.suburb = value.suburb
      this.shipping.town = value.town
      this.shipping.state = value.state
      this.shipping.country = value.country
      this.shipping.postal_code = value.postal_code
      this.shipping.user.id = value.user.id
      this.shipping.user.name = value.user.name

      $('#updateShipping').modal('show')
    }
  }
}

</script>
