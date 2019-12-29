<template>
  <div id="updateSubCategory" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formsubcategoryupdate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="updateSubCategorySubmit(subcategory)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Editar sub categoria
            </h5>
          </div>

          <div v-if="errorUpdate.length">
            <div v-for="updateerror in errorUpdate" :key="updateerror" class="alert alert-danger text-center rounded-0" role="alert">
              {{ updateerror }}
            </div>
          </div>

          <modalSubCategoryForm :subcategory="subcategory" :categories="categories" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="updateSubCategoryReset()">
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
import axios from 'axios'
import { ToadAlert } from '../helpers'

export default {
  components: {
    modalSubCategoryForm: modalSubCategoryForm
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
      errorUpdate: []
    }
  },
  methods: {
    updateSubCategorySubmit: function (subcategory) {
      var data = {
        category_id: this.subcategory.category.id,
        name: subcategory.name.toLowerCase(),
        description: subcategory.description.toLowerCase(),
        status: 1
      }

      this.$refs.formsubcategoryupdate.validate().then(success => {
        if (!success) {
          return
        }

        axios.put('/api/v1/subcategories/' + subcategory.id, data).then((response) => {
          if (response.status === 200) {
            $('#updateSubCategory').modal('hide')

            this.index(this.state)
            this.updateSubCategoryReset()

            ToadAlert.toad('La categoria se actualizo correctamente')
          }
        }).catch(error => {
          this.errorUpdate = error.response.data.errors.category_id
        })
      })
    },
    updateSubCategoryReset: function () {
      this.subcategory.id = 0
      this.subcategory.category.id = 0
      this.subcategory.name = ''
      this.subcategory.description = ''
      this.errorUpdate = []
      this.$refs.formsubcategoryupdate.reset()
    }
  }
}

</script>
