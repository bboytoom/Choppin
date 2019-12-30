<template>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Categoria</label>
          <validation-provider v-slot="{ errors, classes }" name="Categoria" rules="required">
            <div class="control" :class="classes">
              <select v-model="subcategory.category.id" class="custom-select" @change="category_id">
                <option disabled value="0">
                  Seleccione un elemento
                </option>
                <option v-for="option in categories" :key="option.id" :value="option.id">
                  {{ option.name }}
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
          <label>Sub Categoria</label>
          <validation-provider v-slot="{ errors, classes }" name="Sub categoria" rules="min:4|max:150|required">
            <div class="control" :class="classes">
              <input v-model="subcategory.name" type="text" class="form-control lower--mdf" placeholder="Ingresa la sub categoria" maxlength="41">
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
              <textarea v-model="subcategory.description" class="form-control lower--mdf" rows="5" placeholder="Ingresa la descripcion de la sub categoria" maxlength="81" />
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
    subcategory: {
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
      return this.subcategory.category.id
    }
  }
}

</script>
