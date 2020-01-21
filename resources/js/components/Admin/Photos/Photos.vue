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
            <input v-model="searchPhotos" type="text" class="form-control" placeholder="Busca la imagen">
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
      <h4 v-if="photos.length == 0" class="text-center">
        No cuentas con imagenes
      </h4>

      <div v-else class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>
                Producto
              </th>
              <th>
                Nombre
              </th>
              <th width="100">
                Imagen
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

          <tablePhoto
            :index="index"
            :photos="filtroPhoto"
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

    <storePhoto
      :photo="photo"
      :productoid="productoid"
      :index="index"
      :state="page_state"
    />
    <updatePhoto
      :photo="photo"
      :productoid="productoid"
      :index="index"
      :state="page_state"
    />
  </div>
</template>

<script>

import tablePhoto from './PhotosTable.vue'
import updatePhoto from './PhotosUpdate.vue'
import storePhoto from './PhotosStore.vue'

export default {
  components: {
    tablePhoto,
    updatePhoto,
    storePhoto
  },
  props: {
    productoid: {
      type: Number,
      default: 0
    }
  },
  data: function () {
    return {
      photos: [],
      number_page: 0,
      page_state: 1,
      searchPhotos: '',
      photo: {
        id: 0,
        name: '',
        image: '',
        url: '',
        temp: '',
        description: '',
        product: {
          id: 0,
          name: ''
        }
      }
    }
  },
  computed: {
    filtroPhoto: function () {
      if (this.searchPhotos) {
        return this.photos.filter((item) => {
          return item.attributes.name.includes(this.searchPhotos)
        })
      } else {
        return this.photos
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      this.$http.get('/photos/all/' + this.productoid + '?page=' + page).then((response) => {
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.photos = response.data.data
      })
    },
    create: function () {
      this.photo.url = '/storage/images/small/20200111034735_producto_default.png'

      $('#createPhoto').modal('show')
    },
    dataEdit: function (value) {
      this.photo.id = value.id
      this.photo.name = value.name
      this.photo.image = value.image
      this.photo.url = value.url
      this.photo.temp = value.url
      this.photo.description = value.description
      this.photo.product.name = value.product.name

      $('#updatePhoto').modal('show')
    }
  }
}

</script>
