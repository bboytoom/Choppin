<template>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Caracteristica</label>
          <validation-provider v-slot="{ errors, classes }" name="Caracteristica" rules="min:4|max:150|required">
            <div class="control" :class="classes">
              <input v-model="characteristic.name" type="text" class="form-control lower--mdf" placeholder="Ingresa la caracteristica" maxlength="151">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Descripcion</label>
          <validation-provider v-slot="{ errors, classes }" name="Descripcion" rules="min:4|max:250">
            <div class="control" :class="classes">
              <textarea v-model="characteristic.description" class="form-control lower--mdf" rows="5" placeholder="Ingresa la descripcion de la caracteristica" maxlength="251" />
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
    characteristic: {
      type: Object,
      default: function () {
        return {}
      }
    }
  }
}

</script>
