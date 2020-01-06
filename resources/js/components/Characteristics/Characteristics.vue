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
            <input v-model="searchCharacteristics" type="text" class="form-control" placeholder="Busca la caracteristica">
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
      <h4 v-if="characteristics.length == 0" class="text-center">
        No cuentas con caracteristicas
      </h4>

      <div v-else class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>
                Producto
              </th>
              <th>
                Caracteristica
              </th>
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

          <tableCharacteristic
            :index="index"
            :characteristics="filtroCharacteristic"
            :productoid="productoid"
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

    <storeCharacteristic
      :characteristic="characteristic"
      :productoid="productoid"
      :index="index"
      :state="page_state"
    />
    <updateCharacteristic
      :characteristic="characteristic"
      :productoid="productoid"
      :index="index"
      :state="page_state"
    />
  </div>
</template>

<script>

import tableCharacteristic from './CharacteristicsTable.vue'
import updateCharacteristic from './CharacteristicsUpdate.vue'
import storeCharacteristic from './CharacteristisStore.vue'

export default {
  components: {
    tableCharacteristic: tableCharacteristic,
    updateCharacteristic: updateCharacteristic,
    storeCharacteristic: storeCharacteristic
  },
  props: {
    productoid: {
      type: Number,
      default: 0
    }
  },
  data: function () {
    return {
      characteristics: [],
      number_page: 0,
      page_state: 1,
      searchCharacteristics: '',
      characteristic: {
        id: 0,
        name: '',
        description: '',
        product: {
          id: 0,
          name: ''
        }
      }
    }
  },
  computed: {
    filtroCharacteristic: function () {
      if (this.searchCharacteristics) {
        return this.characteristics.filter((item) => {
          return item.attributes.name.includes(this.searchCharacteristics)
        })
      } else {
        return this.characteristics
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      this.$http.get('/api/v1/characteristics/all/' + this.productoid + '?page=' + page).then((response) => {
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.characteristics = response.data.data
      })
    },
    create: function () {
      $('#createCharacteristic').modal('show')
    },
    dataEdit: function (value) {
      this.characteristic.id = value.id
      this.characteristic.name = value.name
      this.characteristic.description = value.description
      this.characteristic.product.name = value.product.name

      $('#updateCharacteristic').modal('show')
    }
  }
}

</script>
