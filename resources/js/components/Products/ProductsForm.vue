<template>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Categoria</label>
          <validation-provider v-slot="{ errors, classes }" name="Categoria" rules="required">
            <div class="control" :class="classes">
              <select v-model="product.subcategory.categoryid" class="custom-select">
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
          <label>Sub categoria</label>
          <validation-provider v-slot="{ errors, classes }" name="sub categoria" rules="required">
            <div class="control" :class="classes">
              <select v-model="product.subcategory.id" class="custom-select">
                <option disabled value="0">
                  Seleccione un elemento
                </option>
                <option v-for="option in SubCategories" :key="option.id" :value="option.id">
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
          <label>Producto</label>
          <validation-provider v-slot="{ errors, classes }" name="Producto" rules="min:4|max:100|required">
            <div class="control" :class="classes">
              <input v-model="product.name" type="text" class="form-control lower--mdf" placeholder="Ingresa el producto" maxlength="41">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Precio</label>
          <validation-provider v-slot="{ errors, classes }" name="Precio" rules="min:1|max:6|required">
            <div class="control" :class="classes">
              <input v-model="product.price" type="text" class="form-control lower--mdf" placeholder="Ingresa el precio" maxlength="7">
              <span>
                {{ errors[0] }}
              </span>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Resumen</label>
          <validation-provider v-slot="{ errors, classes }" name="Resumen" rules="min:4|max:150">
            <div class="control" :class="classes">
              <textarea v-model="product.extract" class="form-control lower--mdf" rows="2" placeholder="Ingresa el resumen del producto" maxlength="151" />
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
              <textarea v-model="product.description" class="form-control lower--mdf" rows="5" placeholder="Ingresa la descripcion del producto" maxlength="251" />
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
    product: {
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
  computed: {
    SubCategories: function () {
      var item = []
      var category = this.categories.filter((item) => {
        return (item.id === this.product.subcategory.categoryid)
      })

      category.forEach(element => {
        item = element.subcategories
      })

      return item
    }
  }
}

</script>
