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
            <input v-model="searchProducts" type="text" class="form-control" placeholder="Busca el producto">
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
      <h4 v-if="products.length == 0" class="text-center">
        No cuentas con productos
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
                Producto
              </th>
              <th class="text-center" width="100">
                Estado
              </th>
              <th class="text-center" width="110">
                Complementos
              </th>
              <th class="text-center" width="110">
                Editar
              </th>
              <th class="text-center" width="110">
                Eliminar
              </th>
            </tr>
          </thead>

          <tableProduct
            :index="index"
            :products="filtroProduct"
            :categories="categories"
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

    <storeProduct
      :product="product"
      :categories="categories"
      :index="index"
      :state="page_state"
    />
    <updateProduct
      :product="product"
      :categories="categories"
      :index="index"
      :state="page_state"
    />
  </div>
</template>

<script>

import tableProduct from './ProductsTable.vue'
import updateProduct from './ProductsUpdate.vue'
import storeProduct from './ProductsStore.vue'

export default {
  components: {
    tableProduct: tableProduct,
    updateProduct: updateProduct,
    storeProduct: storeProduct
  },
  data: function () {
    return {
      products: [],
      categories: [],
      number_page: 0,
      page_state: 1,
      searchProducts: '',
      product: {
        id: 0,
        name: '',
        extract: '',
        description: '',
        price: '',
        subcategory: {
          id: 0,
          categoryid: 0,
          name: ''
        }
      }
    }
  },
  computed: {
    filtroProduct: function () {
      if (this.searchProducts) {
        return this.products.filter((item) => {
          return item.attributes.name.includes(this.searchProducts)
        })
      } else {
        return this.products
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      this.$http.get('/api/v1/products?page=' + page).then((response) => {
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.products = response.data.data
        this.categories = response.data.categories
      })
    },
    create: function () {
      $('#createProduct').modal('show')
    },
    dataEdit: function (value) {
      this.product.id = value.id
      this.product.name = value.name
      this.product.extract = value.extract
      this.product.description = value.description
      this.product.price = value.price
      this.product.subcategory.id = value.subcategory.id
      this.product.subcategory.categoryid = value.subcategory.categoryid
      this.product.subcategory.name = value.subcategory.name

      $('#updateProduct').modal('show')
    }
  }
}

</script>
