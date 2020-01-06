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
            <input v-model="searchSubCategories" type="text" class="form-control" placeholder="Busca la sub categoria">
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
      <h4 v-if="subcategories.length == 0" class="text-center">
        No cuentas con sub categorias
      </h4>

      <div v-else class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>
                Categoria
              </th>
              <th>
                Sub categoria
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

          <tableSubCategory
            :index="index"
            :subcategories="filtroSubCategory"
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

    <storeSubCategory
      :subcategory="subcategory"
      :categories="categories"
      :index="index"
      :state="page_state"
    />
    <updateSubCategory
      :subcategory="subcategory"
      :categories="categories"
      :index="index"
      :state="page_state"
    />
  </div>
</template>

<script>

import tableSubCategory from './SubCategpriesTable.vue'
import updateSubCategory from './SubCategoriesUpdate.vue'
import storeSubCategory from './SubCategoriesStore.vue'

export default {
  components: {
    tableSubCategory: tableSubCategory,
    updateSubCategory: updateSubCategory,
    storeSubCategory: storeSubCategory
  },
  data: function () {
    return {
      subcategories: [],
      categories: [],
      number_page: 0,
      page_state: 1,
      searchSubCategories: '',
      subcategory: {
        id: 0,
        name: '',
        description: '',
        category: {
          id: 0,
          name: ''
        }
      }
    }
  },
  computed: {
    filtroSubCategory: function () {
      if (this.searchSubCategories) {
        return this.subcategories.filter((item) => {
          return item.attributes.name.includes(this.searchSubCategories)
        })
      } else {
        return this.subcategories
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      this.$http.get('/api/v1/subcategories?page=' + page).then((response) => {
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.subcategories = response.data.data
        this.categories = response.data.categories
      })
    },
    create: function () {
      $('#createSubCategory').modal('show')
    },
    dataEdit: function (value) {
      this.subcategory.id = value.id
      this.subcategory.name = value.name
      this.subcategory.description = value.description
      this.subcategory.category.id = value.category.id
      this.subcategory.category.name = value.category.name

      $('#updateSubCategory').modal('show')
    }
  }
}

</script>
