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
            <input v-model="searchCategories" type="text" class="form-control" placeholder="Busca la categoria">
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
      <h4 v-if="categories.length == 0" class="text-center">
        No cuentas con categorias
      </h4>

      <div v-else class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>
                Categoria
              </th>
              <th>
                Descripcion
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

          <tableCategory
            :index="index"
            :categories="filtroCategory"
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

    <storeCategory
      :category="category"
      :index="index"
      :state="page_state"
    />
    <updateCategory
      :category="category"
      :index="index"
      :state="page_state"
    />
  </div>
</template>

<script>

import tableCategory from './CategoriesTable.vue'
import storeCategory from './CategoriesStore.vue'
import updateCategory from './CategoriesUpdate.vue'

export default {
  components: {
    tableCategory,
    storeCategory,
    updateCategory
  },
  data: function () {
    return {
      categories: [],
      number_page: 0,
      page_state: 1,
      searchCategories: '',
      category: {
        id: 0,
        name: '',
        description: ''
      }
    }
  },
  computed: {
    filtroCategory: function () {
      if (this.searchCategories) {
        return this.categories.filter((item) => {
          return item.attributes.name.includes(this.searchCategories)
        })
      } else {
        return this.categories
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      this.$http.get('/api/v1/categories?page=' + page).then((response) => {
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.categories = response.data.data
      })
    },
    create: function () {
      $('#createCategory').modal('show')
    },
    dataEdit: function (value) {
      this.category.id = value.id
      this.category.name = value.name
      this.category.description = value.description

      $('#updateCategory').modal('show')
    }
  }
}

</script>
