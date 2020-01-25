<template>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Categoria</label>
          <validation-provider v-slot="{ errors, classes }" name="Categoria" rules="required">
            <div class="control" :class="classes">
              <select v-model="gallery.category.id" class="custom-select" @change="category_id">
                <option disabled value="0">
                  Seleccione un elemento
                </option>
                <option v-for="option in categories" :key="option.id" :value="option.id">
                  {{ option.name | capitalize }}
                </option>
              </select>
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Nombre</label>
          <validation-provider v-slot="{ errors, classes }" name="Nombre" rules="min:4|max:30|required">
            <div class="control" :class="classes">
              <input v-model="gallery.name" type="text" class="form-control lower--mdf" placeholder="Ingresa el nombre de la galeria" maxlength="41">
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
    gallery: {
      type: Object,
      default: function () {
        return {}
      }
    },
    categories: {
      type: Array,
      default: function () {
        return []
      }
    }
  },
  methods: {
    category_id: function () {
      return this.gallery.category.id
    }
  }
}

</script>
