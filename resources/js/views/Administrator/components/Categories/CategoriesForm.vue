<template>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Categoria</label>
          <validation-provider v-slot="{ errors, classes }" name="Categoria" rules="min:4|max:150|required">
            <div class="control" :class="classes">
              <input v-model="category.name" type="text" class="form-control lower--mdf" placeholder="Ingresa la categoria" maxlength="41">
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
          <validation-provider v-slot="{ errors, classes }" name="Descripcion" rules="min:4|max:80">
            <div class="control" :class="classes">
              <textarea v-model="category.description" class="form-control lower--mdf" rows="5" placeholder="Ingresa la descripcion de la categoria" maxlength="81" />
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
    category: {
      type: Object,
      default: function () {
        return {}
      }
    }
  }
}

</script>
