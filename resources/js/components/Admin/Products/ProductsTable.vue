<template>
  <tbody>
    <tr v-for="item in products" :key="item.id">
      <td>
        {{ category(categories, item.subcategory.categoryid) | capitalize }}
      </td>

      <td>
        {{ item.subcategory.name | capitalize }}
      </td>

      <td>
        {{ item.attributes.name | capitalize }}
      </td>

      <td class="text-center">
        <div class="custom-control custom-switch">
          <input :id="`status_${item.id}`" type="checkbox" class="custom-control-input" :checked="item.attributes.status == 1" @click.prevent="editStatus(item.id, item.attributes, item.subcategory.id)">
          <label class="custom-control-label" :for="`status_${item.id}`" />
        </div>
      </td>

      <td class="text-center">
        <button type="button" class="btn btn-info btn-circle" @click.prevent="complemento(item.id)">
          <i class="fas fa-cog" />
        </button>
      </td>

      <td class="text-center">
        <button type="button" class="btn btn-warning btn-circle" @click.prevent="edit(item.id)">
          <i class="fas fa-pen" />
        </button>
      </td>

      <td class="text-center">
        <button type="button" class="btn btn-danger btn-circle" @click.prevent="deleted(item.id)">
          <i class="fas fa-trash-alt" />
        </button>
      </td>
    </tr>
  </tbody>
</template>

<script>

export default {
  props: {
    products: {
      type: Array,
      default: function () {
        return []
      }
    },
    categories: {
      type: Array,
      default: function () {
        return []
      }
    },
    index: {
      type: Function,
      default: function () {
        return 1
      }
    },
    state: {
      type: Number,
      default: 0
    }
  },
  methods: {
    category: function (categories, id) {
      var prueba = ''

      var obj = categories.filter((item) => {
        return item
      })

      obj.forEach(elemento => {
        if (elemento.id === id) {
          prueba = elemento.name
        }
      })

      return prueba
    },
    edit: function (id) {
      this.$http.get('/api/v1/products/' + id).then((response) => {
        this.$emit('dataEdit', {
          id: response.data.id,
          name: response.data.attributes.name,
          extract: response.data.attributes.extract,
          description: response.data.attributes.description,
          price: response.data.attributes.price,
          subcategory: {
            id: response.data.subcategory.id,
            categoryid: response.data.subcategory.categoryid,
            name: response.data.subcategory.name
          }
        })
      })
    },
    deleted: function (id) {
      this.$swal.fire({
        html: '<h6><strong>Seguro que quiere eliminar el producto</strong></h6>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '21rem',
        preConfirm: () => {
          this.$http.delete('/api/v1/products/' + id).then((response) => {
            if (response.status === 204) {
              this.$http.get('/api/v1/products').then((response) => {
                if (this.state > parseInt(response.data.meta.last_page)) {
                  this.index(parseInt(response.data.meta.last_page))
                } else {
                  this.index(this.state)
                }

                this.$toad.toad('El producto se elimino correctamente')
              })
            }
          })
        }
      })
    },
    complemento: function (id) {
      window.location.href = window.location + '/' + btoa(id) + '/edit'
    },
    editStatus: function (id, attr, subcategoryId) {
      this.$swal.fire({
        html: '<h6><strong>Desea cambiar el estatus de la sub categoria</strong></h6>',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '21rem',
        preConfirm: () => {
          this.$http.put('/api/v1/products/' + id, {
            subcategory_id: subcategoryId,
            name: attr.name,
            extract: attr.extract,
            description: attr.description,
            price: attr.price,
            status: (attr.status === 1) ? 0 : 1
          }).then((response) => {
            if (response.status === 200) {
              this.index(this.state)
            }
          })
        }
      })
    }
  }
}

</script>
