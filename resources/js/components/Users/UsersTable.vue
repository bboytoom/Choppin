<template>
  <tbody>
    <tr v-for="item in users" :key="item.id">
      <td>
        {{ item.attributes.name | capitalize }}
        {{ item.attributes.father_surname | capitalize }}
        {{ item.attributes.mother_surname === null ? '': item.attributes.mother_surname | capitalize }}
      </td>
      <td>
        {{ item.attributes.email }}
      </td>

      <td class="text-center">
        <div class="custom-control custom-switch">
          <input :id="`status_${item.id}`" type="checkbox" class="custom-control-input" :checked="item.attributes.status == 1" @click.prevent="editStatus(item.id, item.attributes)">
          <label class="custom-control-label" :for="`status_${item.id}`" />
        </div>
      </td>

      <td class="text-center">
        <button type="button" class="btn btn-secondary btn-sm" @click.prevent="password(item.id)">
          <i class="fas fa-lock" />
        </button>
      </td>

      <td class="text-center">
        <button type="button" class="btn btn-info btn-circle" @click.prevent="complemento(item.id)">
          <i class="fas fa-cogs" />
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

import axios from 'axios'
import Swal from 'sweetalert2'
import { ToadAlert } from '../helpers'

export default {
  props: {
    users: {
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
      axios.get('/api/v1/users/' + id).then((response) => {
        this.$emit('dataEdit', {
          id: response.data.id,
          name: response.data.attributes.name,
          mother_surname: response.data.attributes.mother_surname,
          father_surname: response.data.attributes.father_surname,
          email: response.data.attributes.email
        })
      })
    },
    deleted: function (id) {
      Swal.fire({
        html: '<h6><strong>Seguro que quiere eliminar al administrador</strong></h6>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '21rem',
        preConfirm: () => {
          axios.delete('/api/v1/users/' + id).then((response) => {
            if (response.status === 204) {
              axios.get('/api/v1/users').then((response) => {
                if (this.state > parseInt(response.data.meta.last_page)) {
                  this.index(parseInt(response.data.meta.last_page))
                } else {
                  this.index(this.state)
                }

                ToadAlert.toad('El usuario se elimino correctamente')
              })
            }
          })
        }
      })
    },
    password: function (id) {
      axios.get('/api/v1/users/' + id).then((response) => {
        this.$emit('passwordEdit', {
          id: response.data.id,
          name: response.data.attributes.name,
          mother_surname: response.data.attributes.mother_surname,
          father_surname: response.data.attributes.father_surname
        })
      })
    },
    complemento: function (id) {
      window.location.href = window.location + '/' + btoa(id) + '/edit'
    },
    editStatus: function (id, attr) {
      Swal.fire({
        html: '<h6><strong>Desea cambiar el estatus del usuario</strong></h6>',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '21rem',
        preConfirm: () => {
          axios.put('/api/v1/users/' + id, {
            name: attr.name,
            father_surname: attr.father_surname,
            email: attr.email,
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
