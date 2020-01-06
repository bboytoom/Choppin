<template>
  <div id="passwordAdmin" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer ref="formadminpassword" v-slot="{ invalid }">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="passwordAdminSubmit(admin, password, password_confimed)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Cambio de contraseña
            </h5>
          </div>

          <div class="alert alert-warning text-center rounded-0" role="alert">
            Cambio de contraseña al usuario
            <strong>
              {{ admin.name + ' ' + admin.father_surname + ' ' + (admin.mother_surname === null ? '': admin.mother_surname) }}
            </strong>
          </div>

          <div v-if="errorPassword.length">
            <div v-for="updatepasserror in errorPassword" :key="updatepasserror" class="alert alert-danger text-center rounded-0" role="alert">
              {{ updatepasserror }}
            </div>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Contraseña</label>
                  <validation-provider v-slot="{ errors, classes }" name="Password" rules="min:7|max:20|required|password:@confirm">
                    <div class="control" :class="classes">
                      <input v-model="password" type="password" class="form-control" placeholder="Ingresa la contraseña" maxlength="21">
                      <span>
                        {{ errors[0] }}
                      </span>
                    </div>
                  </validation-provider>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Repite la contraseña</label>
                  <validation-provider v-slot="{ errors, classes }" name="confirm" rules="min:7|max:20|required">
                    <div class="control" :class="classes">
                      <input v-model="password_confimed" type="password" class="form-control" placeholder="Repite la contraseña" maxlength="21">
                      <span>
                        {{ errors[0] }}
                      </span>
                    </div>
                  </validation-provider>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="passwordAdminReset()">
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

export default {
  props: {
    admin: {
      type: Object,
      default: function () {
        return {}
      }
    }
  },
  data: function () {
    return {
      password: '',
      password_confimed: '',
      errorPassword: []
    }
  },
  methods: {
    passwordAdminSubmit: function (admin, password, confirmation) {
      var data = {
        password: password,
        password_confirmation: confirmation
      }

      this.$refs.formadminpassword.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.put('/api/v1/adminpassword/' + admin.id, data).then((response) => {
          if (response.status === 200) {
            $('#passwordAdmin').modal('hide')

            this.passwordAdminReset()
            this.$toad.toad('La contraseña se actualizo correctamente')
          }
        }).catch(error => {
          this.errorPassword = error.response.data.errors.password
        })
      })
    },
    passwordAdminReset: function () {
      this.admin.id = 0
      this.admin.name = ''
      this.admin.mother_surname = ''
      this.admin.father_surname = ''
      this.password = ''
      this.password_confimed = ''
      this.errorPassword = []
      this.$refs.formadminpassword.reset()
    }
  }
}

</script>
