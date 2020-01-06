<template>
  <div id="updateCategory" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formcategoryupdate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="updateCategorySubmit(category)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Editar categoria
            </h5>
          </div>

          <modalCategoryForm :category="category" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="updateCategoryReset()">
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

import modalCategoryForm from './CategoriesForm.vue'

export default {
  components: {
    modalCategoryForm: modalCategoryForm
  },
  props: {
    category: {
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
  methods: {
    updateCategorySubmit: function (category) {
      var data = {
        name: category.name.toLowerCase(),
        description: category.description.toLowerCase(),
        status: 1
      }

      this.$refs.formcategoryupdate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.put('/api/v1/categories/' + category.id, data).then((response) => {
          if (response.status === 200) {
            $('#updateCategory').modal('hide')

            this.index(this.state)
            this.updateCategoryReset()

            this.$toad.toad('La categoria se actualizo correctamente')
          }
        })
      })
    },
    updateCategoryReset: function () {
      this.category.id = 0
      this.category.name = ''
      this.category.description = ''
      this.$refs.formcategoryupdate.reset()
    }
  }
}

</script>
