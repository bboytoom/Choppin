<template>
  <tbody>
    <tr v-for="item in shippings" :key="item.id">
      <td>
        {{ item.attributes.street_one | capitalize }}
      </td>

      <td>
        {{ item.attributes.addres | capitalize }}
      </td>

      <td>
        {{ item.attributes.suburb | capitalize }}
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

import axios from 'axios'
import Swal from 'sweetalert2'
import { ToadAlert } from '../helpers'

export default {
  props: {
    shippings: {
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
    },
    userid: {
      type: Number,
      default: 0
    }
  },
  methods: {
    edit: function (id) {
      axios.get('/api/v1/shippings/' + id).then((response) => {
        this.$emit('dataEdit', {
          id: response.data.id,
          street_one: response.data.attributes.street_one,
          street_two: response.data.attributes.street_two,
          addres: response.data.attributes.addres,
          suburb: response.data.attributes.suburb,
          town: response.data.attributes.town,
          state: response.data.attributes.state,
          country: response.data.attributes.country,
          postal_code: response.data.attributes.postal_code,
          user: {
            id: response.data.user.id,
            name: response.data.user.name
          }
        })
      })
    },
    deleted: function (id) {
      Swal.fire({
        html: '<h6><strong>Seguro que quiere eliminar la direccion</strong></h6>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '21rem',
        preConfirm: () => {
          axios.delete('/api/v1/shippings/' + id).then((response) => {
            if (response.status === 204) {
              axios.get('/api/v1/shippings/all/' + this.userid).then((response) => {
                if (this.state > parseInt(response.data.meta.last_page)) {
                  this.index(parseInt(response.data.meta.last_page))
                } else {
                  this.index(this.state)
                }

                ToadAlert.toad('La direccion se elimino correctamente')
              })
            }
          })
        }
      })
    },
    editStatus: function (id, attr) {
      Swal.fire({
        html: '<h6><strong>Desea cambiar el estatus de la direccion</strong></h6>',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '21rem',
        preConfirm: () => {
          axios.put('/api/v1/shippings/' + id, {
            user_id: this.userid,
            street_one: attr.street_one,
            street_two: attr.street_two,
            addres: attr.addres,
            suburb: attr.suburb,
            town: attr.town,
            state: attr.state,
            country: attr.country,
            postal_code: attr.postal_code,
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
