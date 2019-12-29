<template>
  <tbody>
    <tr v-for="item in subcategories" :key="item.id">
      <td>
        {{ item.category.name | capitalize }}
      </td>

      <td>
        {{ item.attributes.name | capitalize }}
      </td>

      <td>
        {{ item.attributes.description | capitalize }}
      </td>

      <td class="text-center">
        <div class="custom-control custom-switch">
          <input :id="`status_${item.id}`" type="checkbox" class="custom-control-input" :checked="item.attributes.status == 1" @click.prevent="editStatus(item.id, item.attributes, item.category.id)">
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

import axios from 'axios'
import Swal from 'sweetalert2'
import { ToadAlert } from '../helpers'

export default {
  props: {
    subcategories: {
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
      axios.get('/api/v1/subcategories/' + id).then((response) => {
        this.$emit('dataEdit', {
          id: response.data.id,
          name: response.data.attributes.name,
          description: response.data.attributes.description,
          category: {
            id: response.data.category.id,
            name: response.data.category.name
          }
        })
      })
    },
    deleted: function (id) {
      Swal.fire({
        html: '<h6><strong>Seguro que quiere eliminar la sub categoria</strong></h6>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '21rem',
        preConfirm: () => {
          axios.delete('/api/v1/subcategories/' + id).then((response) => {
            if (response.status === 204) {
              axios.get('/api/v1/subcategories').then((response) => {
                if (this.state > parseInt(response.data.meta.last_page)) {
                  this.index(parseInt(response.data.meta.last_page))
                } else {
                  this.index(this.state)
                }

                ToadAlert.toad('La sub categoria se elimino correctamente')
              })
            }
          })
        }
      })
    },
    editStatus: function (id, attr, categoryId) {
      Swal.fire({
        html: '<h6><strong>Desea cambiar el estatus de la sub categoria</strong></h6>',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '21rem',
        preConfirm: () => {
          axios.put('/api/v1/subcategories/' + id, {
            category_id: categoryId,
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
