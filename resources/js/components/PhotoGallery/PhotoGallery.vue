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
            <input v-model="searchPhotosGallery" type="text" class="form-control" placeholder="Busca la imagen">
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
      <h4 v-if="photosgalleries.length == 0" class="text-center">
        No cuentas con imagenes
      </h4>

      <div v-else class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>
                galleria
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

          <!-- tabla -->
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

    <!-- modal -->
  </div>
</template>

<script>

export default {
  components: {

  },
  props: {
    galleryid: {
      type: Number,
      default: 0
    }
  },
  data: function () {
    return {
      photosgalleries: [],
      number_page: 0,
      page_state: 1,
      searchPhotosGallery: '',
      photogallery: {
        id: 0,
        name: '',
        image: '',
        url: '',
        temp: '',
        description: '',
        gallery: {
          id: 0,
          name: ''
        }
      }
    }
  },
  computed: {
    filtroPhotoGallery: function () {
      if (this.searchPhotosGallery) {
        return this.photosgalleries.filter((item) => {
          return item.attributes.name.includes(this.searchPhotosGallery)
        })
      } else {
        return this.photosgalleries
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      this.$http.get('/api/v1/photosgalleries/all/' + this.productoid + '?page=' + page).then((response) => {
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.photosgalleries = response.data.data
      })
    },
    create: function () {
      this.photogallery.url = '/storage/images/small/20200111034735_producto_default.png'

      $('#createPhotoGallery').modal('show')
    },
    dataEdit: function (value) {
      this.photogallery.id = value.id
      this.photogallery.name = value.name
      this.photogallery.image = value.image
      this.photogallery.url = value.url
      this.photogallery.temp = value.url
      this.photogallery.description = value.description
      this.photo.gallery.name = value.gallery.name

      $('#updatePhotoGallery').modal('show')
    }
  }
}

</script>
