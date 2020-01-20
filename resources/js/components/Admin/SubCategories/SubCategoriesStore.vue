<template>
  <div id="createSubCategory" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formsubcategorycreate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="createSubCategorySubmit(subcategory)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Crear sub categoria
            </h5>
          </div>

          <div v-if="errorCreate.length">
            <div v-for="createerror in errorCreate" :key="createerror" class="alert alert-danger text-center rounded-0" role="alert">
              {{ createerror }}
            </div>
          </div>

          <modalSubCategoryForm :subcategory="subcategory" :categories="categories" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="createSubCategoryReset()">
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

import modalSubCategoryForm from './SubCategoriesForm.vue'

export default {
  components: {
    modalSubCategoryForm
  },
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
  data: function () {
    return {
      errorCreate: []
    }
  },
  methods: {
    createSubCategorySubmit: function (subcategory) {
      var data = {
        category_id: this.subcategory.category.id,
        name: subcategory.name.toLowerCase(),
        description: subcategory.description.toLowerCase(),
        status: 1
      }

      this.$refs.formsubcategorycreate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.post('/api/v1/subcategories/', data).then((response) => {
          if (response.status === 201) {
            $('#createSubCategory').modal('hide')

            this.index(this.state)
            this.createSubCategoryReset()

            this.$toad.toad('La sub categoria se agrego correctamente')
          }
        }).catch(error => {
          this.errorCreate = error.response.data.errors.category_id
        })
      })
    },
    createSubCategoryReset: function () {
      this.subcategory.id = 0
      this.subcategory.category.id = 0
      this.subcategory.name = ''
      this.subcategory.description = ''
      this.errorCreate = []
      this.$refs.formsubcategorycreate.reset()
    }
  }
}

</script>
