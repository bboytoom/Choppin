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
            <input v-model="searchConfigurations" type="text" class="form-control" placeholder="Busca la configuracion">
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
      <h4 v-if="configurations.length == 0" class="text-center">
        No cuentas con ninguna configuracion
      </h4>

      <div v-else class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center" width="140">
                Logo
              </th>
              <th>
                Dominio
              </th>
              <th>
                name
              </th>
              <th>
                Correo
              </th>
              <th>
                telefono
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

          <tableConfiguration
            :index="index"
            :configurations="filtroConfiguration"
            :state="page_state"
            @dataEdit="dataEdit"
            @dataEditImage="dataEditImage"
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

    <storeConfiguration
      :configuration="configuration"
      :index="index"
      :state="page_state"
    />
    <updateConfiguration
      :configuration="configuration"
      :index="index"
      :state="page_state"
    />
    <imageConfiguration
      :configuration="configuration"
      :index="index"
      :state="page_state"
    />
  </div>
</template>

<script>

import tableConfiguration from './ConfigurationsTable.vue'
import storeConfiguration from './ConfigurationsStore.vue'
import updateConfiguration from './ConfigurationsUpdate.vue'
import imageConfiguration from './ConfigurationsImage.vue'

export default {
  components: {
    tableConfiguration: tableConfiguration,
    storeConfiguration: storeConfiguration,
    updateConfiguration: updateConfiguration,
    imageConfiguration: imageConfiguration
  },
  data: function () {
    return {
      configurations: [],
      number_page: 0,
      page_state: 1,
      searchConfigurations: '',
      configuration: {
        id: 0,
        domain: '',
        name: '',
        business_name: '',
        slogan: '',
        email: '',
        phone: '',
        logo: {
          name: '',
          size: 0,
          image: ''
        }
      }
    }
  },
  computed: {
    filtroConfiguration: function () {
      if (this.searchConfigurations) {
        return this.configurations.filter((item) => {
          return item.attributes.name.includes(this.searchConfigurations)
        })
      } else {
        return this.configurations
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      this.$http.get('/api/v1/configurations?page=' + page).then((response) => {
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.configurations = response.data.data
      })
    },
    create: function () {
      $('#createConfiguration').modal('show')
    },
    dataEdit: function (value) {
      this.configuration.id = value.id
      this.configuration.domain = value.domain
      this.configuration.name = value.name
      this.configuration.business_name = value.business_name
      this.configuration.slogan = value.slogan
      this.configuration.email = value.email
      this.configuration.phone = value.phone

      $('#updateConfiguration').modal('show')
    },
    dataEditImage: function (value) {
      this.configuration.id = value.id
      this.configuration.logo.name = value.logo
      this.configuration.logo.image = value.image

      $('#imageConfiguration').modal('show')
    }
  }
}

</script>
