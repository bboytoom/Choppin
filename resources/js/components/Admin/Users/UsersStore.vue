<template>
  <div id="createUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formcreate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="createUserSubmit(user)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Crear usuario
            </h5>
          </div>

          <div v-if="errorCreate.length">
            <div v-for="createerror in errorCreate" :key="createerror" class="alert alert-danger text-center rounded-0" role="alert">
              {{ createerror }}
            </div>
          </div>

          <modalForm :user="user" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="createUserReset()">
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

import modalForm from './UsersForm.vue'

export default {
  components: {
    modalForm
  },
  props: {
    user: {
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
    createUserSubmit: function (user) {
      var data = {
        name: user.name.toLowerCase(),
        mother_surname: user.mother_surname.toLowerCase(),
        father_surname: user.father_surname.toLowerCase(),
        email: user.email.toLowerCase(),
        status: 1
      }

      this.$refs.formcreate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.post('/users/', data).then((response) => {
          if (response.status === 201) {
            $('#createUser').modal('hide')

            this.index(this.state)
            this.createUserReset()

            this.$toad.toad('El usuario se agrego correctamente')
          }
        }).catch(error => {
          this.errorCreate = error.response.data.errors.email
        })
      })
    },
    createUserReset: function () {
      this.user.id = 0
      this.user.name = ''
      this.user.mother_surname = ''
      this.user.father_surname = ''
      this.user.email = ''
      this.errorCreate = []
      this.$refs.formcreate.reset()
    }
  }
}

</script>
