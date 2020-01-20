<template>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Calle uno</label>
          <validation-provider v-slot="{ errors, classes }" name="Calle uno" rules="min:4|max:100|required">
            <div class="control" :class="classes">
              <input v-model="shipping.street_one" type="text" class="form-control lower--mdf" placeholder="Ingresa la calle" maxlength="101">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Calle dos</label>
          <validation-provider v-slot="{ errors, classes }" name="Calle dos" rules="min:4|max:100">
            <div class="control" :class="classes">
              <input v-model="shipping.street_two" type="text" class="form-control lower--mdf" placeholder="Ingresa la calle" maxlength="101">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Direccion</label>
          <validation-provider v-slot="{ errors, classes }" name="Direccion" rules="min:4|max:80|required">
            <div class="control" :class="classes">
              <input v-model="shipping.addres" type="text" class="form-control lower--mdf" placeholder="Ingresa la direccion" maxlength="81">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Colonia</label>
          <validation-provider v-slot="{ errors, classes }" name="Colonia" rules="min:4|max:80|required">
            <div class="control" :class="classes">
              <input v-model="shipping.suburb" type="text" class="form-control lower--mdf" placeholder="Ingresa la colonia" maxlength="81">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Municipio</label>
          <validation-provider v-slot="{ errors, classes }" name="Municipio" rules="min:4|max:80|required">
            <div class="control" :class="classes">
              <input v-model="shipping.town" type="text" class="form-control lower--mdf" placeholder="Ingresa el municipio" maxlength="81">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Estado</label>
          <validation-provider v-slot="{ errors, classes }" name="Estado" rules="min:4|max:40|required">
            <div class="control" :class="classes">
              <input v-model="shipping.state" type="text" class="form-control lower--mdf" placeholder="Ingresa el estado" maxlength="41">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Pais</label>
          <validation-provider v-slot="{ errors, classes }" name="Pais" rules="min:4|max:20|required">
            <div class="control" :class="classes">
              <input v-model="shipping.country" type="text" class="form-control lower--mdf" placeholder="Ingresa el pais" maxlength="21">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Codigo postal</label>
          <validation-provider v-slot="{ errors, classes }" name="Codigo postal" rules="length:5|numeric|integer|digits:5|alpha_dash|required">
            <div class="control" :class="classes">
              <input v-model="shipping.postal_code" type="text" class="form-control lower--mdf" placeholder="Ingresa el codigo postal" maxlength="5">
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
    shipping: {
      type: Object,
      default: function () {
        return {}
      }
    }
  }
}

</script>
