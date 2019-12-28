<template>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Nombre</label>
          <validation-provider v-slot="{ errors, classes }" name="Nombre" rules="min:3|max:40|required">
            <div class="control" :class="classes">
              <input v-model="user.name" type="text" class="form-control lower--mdf" placeholder="Ingresa tu nombre" maxlength="41">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Apellido paterno</label>
          <validation-provider v-slot="{ errors, classes }" name="Apellido paterno" rules="min:4|max:30|required">
            <div class="control" :class="classes">
              <input v-model="user.father_surname" type="text" class="form-control lower--mdf" placeholder="Ingresa tu apellido" maxlength="31">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Apellido materno</label>
          <validation-provider v-slot="{ errors, classes }" name="Apellido materno" rules="min:4|max:30">
            <div class="control" :class="classes">
              <input v-model="user.mother_surname" type="text" class="form-control lower--mdf" placeholder="Ingresa tu apellido" maxlength="31">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Correo electronico</label>
          <validation-provider v-slot="{ errors, classes }" name="Correo electronico" rules="min:8|max:80|required|email">
            <div class="control" :class="classes">
              <input v-model="user.email" type="email" class="form-control lower--mdf" placeholder="Ingresa tu correo electronico" maxlength="81">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    user: {
      type: Object,
      default: function () {
        return {}
      }
    }
  }
}

</script>
