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
            <input v-model="searchPhotosSlide" type="text" class="form-control" placeholder="Busca la imagen">
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
      <h4 v-if="photosslide.length == 0" class="text-center">
        No cuentas con imagenes
      </h4>

      <div v-else class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead>
            <tr>
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

          <photoSlideTabla
            :index="index"
            :photosslide="filtroPhotoSlide"
            :slideid="slideid"
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

    <photoSlideStore
      :photoslide="photoslide"
      :slideid="slideid"
      :index="index"
      :state="page_state"
    />
    <photoSlideupdate
      :photoslide="photoslide"
      :slideid="slideid"
      :index="index"
      :state="page_state"
    />
  </div>
</template>

<script>

import photoSlideTabla from './PhotoSlideTabla.vue'
import photoSlideStore from './PhotoSlideStore.vue'
import photoSlideupdate from './PhotoSlideupdate.vue'

export default {
  components: {
    photoSlideTabla,
    photoSlideupdate,
    photoSlideStore
  },
  props: {
    slideid: {
      type: Number,
      default: 0
    }
  },
  data: function () {
    return {
      photosslide: [],
      number_page: 0,
      page_state: 1,
      searchPhotosSlide: '',
      photoslide: {
        id: 0,
        name: '',
        image: '',
        url: '',
        temp: '',
        description: '',
        configuration: {
          id: 0,
          name: ''
        }
      }
    }
  },
  computed: {
    filtroPhotoSlide: function () {
      if (this.searchPhotosSlide) {
        return this.photosslide.filter((item) => {
          return item.attributes.name.includes(this.searchPhotosSlide)
        })
      } else {
        return this.photosslide
      }
    }
  },
  created: function () {
    this.index()
  },
  methods: {
    index: function (page) {
      this.$http.get('/api/v1/photoslide/all/' + this.slideid + '?page=' + page).then((response) => {
        console.log(response)
        this.page_state = page
        this.number_page = parseInt(response.data.meta.last_page)
        this.photosslide = response.data.data
      })
    },
    create: function () {
      this.photoslide.url = '/storage/images/small/20200111034735_producto_default.png'

      $('#createPhotoSlide').modal('show')
    },
    dataEdit: function (value) {
      this.photoslide.id = value.id
      this.photoslide.name = value.name
      this.photoslide.image = value.image
      this.photoslide.url = value.url
      this.photoslide.temp = value.url
      this.photoslide.description = value.description
      this.photoslide.configuration.name = value.configuration.name

      $('#updatePhotoSlide').modal('show')
    }
  }
}

</script>
