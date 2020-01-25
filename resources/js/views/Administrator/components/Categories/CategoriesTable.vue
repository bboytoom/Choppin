<template>
  <tbody>
    <tr v-for="item in categories" :key="item.id">
      <td>
        {{ item.attributes.name | capitalize }}
      </td>

      <td>
        {{ item.attributes.description | capitalize }}
      </td>

      <td class="text-center">
        <div class="custom-control custom-switch">
          <input :id="`status_${item.id}`" type="checkbox" class="custom-control-input" :checked="item.attributes.status == 1" @click.prevent="editStatus(item.id, item.attributes)">
          <label class="custom-control-label" :for="`status_${item.id}`" />
        </div>
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
    edit: function (id) {
      this.$http.get('/categories/' + id).then((response) => {
        this.$emit('dataEdit', {
          id: response.data.id,
          name: response.data.attributes.name,
          description: response.data.attributes.description
        })
      })
    },
    deleted: function (id) {
      this.$swal.fire({
        html: '<h6><strong>Seguro que quiere eliminar la categoria</strong></h6>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '21rem',
        preConfirm: () => {
          this.$http.delete('/categories/' + id).then((response) => {
            if (response.status === 204) {
              this.$http.get('/categories').then((response) => {
                if (this.state > parseInt(response.data.meta.last_page)) {
                  this.index(parseInt(response.data.meta.last_page))
                } else {
                  this.index(this.state)
                }

                this.$toad.toad('La categoria se elimino correctamente')
              })
            }
          })
        }
      })
    },
    editStatus: function (id, attr) {
      this.$swal.fire({
        html: '<h6><strong>Desea cambiar el estatus de la categoria</strong></h6>',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '21rem',
        preConfirm: () => {
          this.$http.put('/categories/' + id, {
            name: attr.name,
            description: attr.description,
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
