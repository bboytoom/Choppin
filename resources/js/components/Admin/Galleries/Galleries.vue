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
            <input v-model="searchGalleries" type="text" class="form-control" placeholder="Busca la galeria">
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
      <h4 v-if="galleries.length == 0" class="text-center">
        No cuentas con galerias
      </h4>

      <div v-else class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center" width="100">
                Activa
              </th>
              <th>
                Categoria
              </th>
              <th>
                Nombre
              </th>
              <th class="text-center" width="100">
                Estado
              </th>
              <th class="text-center" width="110">
                Imagenes
              </th>
              <th class="text-center" width="110">
                Editar
              </th>
              <th class="text-center" width="110">
                Eliminar
              </th>
            </tr>
          </thead>

          <tableGallery
            :index="index"
            :galleries="filtroGallery"
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

    <storeGallery
      :gallery="gallery"
      :categories="categories"
      :index="index"
      :state="page_state"
    />
    <updateGallery
      :gallery="gallery"
      :categories="categories"
      :index="index"
      :state="page_state"
    />
  </div>
</template>

<script>

import tableGallery from './GalleriesTable.vue'
import updateGallery from './GalleriesUpdate.vue'
import storeGallery from './GalleriesStore.vue'

export default {
  components: {
    tableGallery,
    updateGallery,
    storeGallery
  },
  data: function () {
    return {
      galleries: [],
      categories: [],
      number_page: 0,
      page_state: 1,
      searchGalleries: '',
      gallery: {
        id: 0,
        name: '',
        category: {
          id: 0,
          name: ''
        }
      }
    }
  },
  computed: {
    filtroGallery: function () {
      if (this.searchGalleries) {
        return this.galleries.filter((item) => {
          return item.attributes.name.includes(this.searchGalleries)
        })
      } else {
        return this.galleries
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      this.$http.get('/galleries?page=' + page).then((response) => {
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.galleries = response.data.data
        this.categories = response.data.categories
      })
    },
    create: function () {
      $('#createGallery').modal('show')
    },
    dataEdit: function (value) {
      this.gallery.id = value.id
      this.gallery.name = value.name
      this.gallery.category.id = value.category.id
      this.gallery.category.name = value.category.name

      $('#updateGallery').modal('show')
    }
  }
}

</script>
