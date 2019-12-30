<template>
  <div id="createProduct" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formproductcreate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="createProductSubmit(product)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Crear producto
            </h5>
          </div>

          <div v-if="errorCreate.length">
            <div v-for="createerror in errorCreate" :key="createerror" class="alert alert-danger text-center rounded-0" role="alert">
              {{ createerror }}
            </div>
          </div>

          <modalProductForm :product="product" :categories="categories" :subcategories="subcategories" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="createProductReset()">
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

import modalProductForm from './ProductsForm.vue'

export default {
  components: {
    modalProductForm: modalProductForm
  },
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
    },
    subcategories: {
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
    createProductSubmit: function (product) {
      console.log(product)
    },
    createProductReset: function () {

    }
  }
}

</script>
