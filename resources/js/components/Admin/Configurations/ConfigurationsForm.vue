<template>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Dominio del sitio</label>
          <validation-provider v-slot="{ errors, classes }" name="Dominio" rules="min:7|max:80|required">
            <div class="control" :class="classes">
              <input v-model="configuration.domain" type="text" class="form-control lower--mdf" placeholder="Ingresa el dominio" maxlength="81">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Nombre del sitio</label>
          <validation-provider v-slot="{ errors, classes }" name="Nombre del sitio" rules="min:4|max:100|required">
            <div class="control" :class="classes">
              <input v-model="configuration.name" type="text" class="form-control lower--mdf" placeholder="Ingresa el nombre del sitio" maxlength="101">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Razon social</label>
          <validation-provider v-slot="{ errors, classes }" name="Razon social" rules="min:6|max:150">
            <div class="control" :class="classes">
              <input v-model="configuration.business_name" type="text" class="form-control lower--mdf" placeholder="Ingresa la razon social" maxlength="151">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Eslogan</label>
          <validation-provider v-slot="{ errors, classes }" name="Eslogan" rules="min:4|max:255">
            <div class="control" :class="classes">
              <input v-model="configuration.slogan" type="text" class="form-control lower--mdf" placeholder="Ingresa el eslogan" maxlength="256">
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
          <validation-provider v-slot="{ errors, classes }" name="Correo electronico" rules="min:7|max:80|required|email">
            <div class="control" :class="classes">
              <input v-model="configuration.email" type="text" class="form-control lower--mdf" placeholder="Ingresa el correo" maxlength="81">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Telefono</label>
          <validation-provider v-slot="{ errors, classes }" name="Telefono" rules="min:8|max:15|required">
            <div class="control" :class="classes">
              <input v-model="configuration.phone" type="text" class="form-control lower--mdf" placeholder="Ingresa el telefono" maxlength="16">
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
    configuration: {
      type: Object,
      default: function () {
        return {}
      }
    }
  }
}

</script>
