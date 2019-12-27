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
            <input id="search_admin" v-model="searchAdmin" type="text" class="form-control" placeholder="Busca al administrador">
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
      <h4 v-if="admins.length == 0" class="text-center">
        No cuentas con administradores
      </h4>
      <div v-else class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Correo</th>
              <th class="text-center" width="100">
                Estado
              </th>
              <th class="text-center" width="140">
                Contraseña
              </th>
              <th class="text-center" width="110">
                Editar
              </th>
              <th class="text-center" width="110">
                Eliminar
              </th>
            </tr>
          </thead>

          <tableAdmin
            :index="index"
            :admins="filtroAdmin"
            :state="page_state"
            @dataEdit="dataEdit"
            @passwordEdit="passwordEdit"
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

    <storeAdmin
      :admin="admin"
      :index="index"
      :state="page_state"
    />
    <updateAdmin
      :admin="admin"
      :index="index"
      :state="page_state"
    />
    <passwordAdmin :admin="admin" />
  </div>
</template>

<script>

import tableAdmin from './AdminsTable.vue'
import storeAdmin from './AdminsStore.vue'
import updateAdmin from './AdminsUpdate.vue'
import passwordAdmin from './AdminsPassword.vue'
import axios from 'axios'

export default {
  components: {
    tableAdmin: tableAdmin,
    passwordAdmin: passwordAdmin,
    storeAdmin: storeAdmin,
    updateAdmin: updateAdmin
  },
  data: function () {
    return {
      admins: [],
      number_page: 0,
      page_state: 1,
      searchAdmin: '',
      admin: {
        id: 0,
        name: '',
        mother_surname: '',
        father_surname: '',
        email: ''
      }
    }
  },
  computed: {
    filtroAdmin: function () {
      if (this.searchAdmin) {
        return this.admins.filter((item) => {
          return item.attributes.name.includes(this.searchAdmin)
        })
      } else {
        return this.admins
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      axios.get('/api/v1/admins?page=' + page).then((response) => {
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.admins = response.data.data
      })
    },
    create: function () {
      $('#createAdmin').modal('show')
    },
    dataEdit: function (value) {
      this.admin.id = value.id
      this.admin.name = value.name
      this.admin.mother_surname = value.mother_surname
      this.admin.father_surname = value.father_surname
      this.admin.email = value.email

      $('#updateAdmin').modal('show')
    },
    passwordEdit: function (value) {
      this.admin.id = value.id
      this.admin.name = value.name
      this.admin.mother_surname = value.mother_surname
      this.admin.father_surname = value.father_surname

      $('#passwordAdmin').modal('show')
    }
  }
}

</script>
