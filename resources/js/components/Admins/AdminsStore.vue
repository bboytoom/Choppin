<template>
  <div id="createAdmin" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formadmincreate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="createAdminSubmit(admin)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Crear administrador
            </h5>
          </div>

          <div v-if="errorCreate.length">
            <div v-for="createerror in errorCreate" :key="createerror" class="alert alert-danger text-center rounded-0" role="alert">
              {{ createerror }}
            </div>
          </div>

          <modalAdminForm :admin="admin" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="createAdminReset()">
              <span class="icon text-white-50">
                <i class="fas fa-arrow-left" />
              </span>
              <span class="text">
                Cancelar
              </span>
            </button>

            <button type="submit" class="btn btn-success btn-icon-split" :disabled="invalid">
              <span class="icon text-white-50">
                <i class="fas fa-check" />
              </span>
              <span class="text">
                Guardar
              </span>
            </button>
          </div>
        </form>
      </validation-observer>
    </div>
  </div>
</template>

<script>

import modalAdminForm from './AdminsForm.vue'

export default {
  components: {
    modalAdminForm: modalAdminForm
  },
  props: {
    admin: {
      type: Object,
      default: function () {
        return {}
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
  data: function () {
    return {
      errorCreate: []
    }
  },
  methods: {
    createAdminSubmit: function (admin) {
      var data = {
        name: admin.name.toLowerCase(),
        mother_surname: admin.mother_surname.toLowerCase(),
        father_surname: admin.father_surname.toLowerCase(),
        email: admin.email.toLowerCase(),
        status: 1
      }

      this.$refs.formadmincreate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.post('/api/v1/admins/', data).then((response) => {
          if (response.status === 201) {
            $('#createAdmin').modal('hide')

            this.index(this.state)
            this.createAdminrReset()

            this.$toad.toad('El administrador se agrego correctamente')
          }
        }).catch(error => {
          this.errorCreate = error.response.data.errors.email
        })
      })
    },
    createAdminReset: function () {
      this.admin.id = 0
      this.admin.name = ''
      this.admin.mother_surname = ''
      this.admin.father_surname = ''
      this.admin.email = ''
      this.errorCreate = []
      this.$refs.formadmincreate.reset()
    }
  }
}

</script>
