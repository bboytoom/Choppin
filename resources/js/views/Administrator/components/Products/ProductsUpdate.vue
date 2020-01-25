<template>
  <div id="updateProduct" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <validation-observer v-slot="{ invalid }" ref="formproductupdate">
        <form method="POST" class="modal-content" autocomplete="off" @submit.prevent="updateProductSubmit(product)">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title title-form__elem">
              Editar producto
            </h5>
          </div>

          <div v-if="errorUpdate.length">
            <div v-for="updateerror in errorUpdate" :key="updateerror" class="alert alert-danger text-center rounded-0" role="alert">
              {{ updateerror }}
            </div>
          </div>

          <modalProductForm :product="product" :categories="categories" />

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" @click.prevent="updateProductReset()">
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
    modalProductForm
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
    updateProductSubmit: function (product) {
      var data = {
        subcategory_id: this.product.subcategory.id,
        name: product.name.toLowerCase(),
        extract: product.extract.toLowerCase(),
        description: product.description.toLowerCase(),
        price: product.price,
        status: 1
      }

      this.$refs.formproductupdate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.put('/products/' + product.id, data).then((response) => {
          if (response.status === 200) {
            $('#updateProduct').modal('hide')

            this.index(this.state)
            this.updateProductReset()

            this.$toad.toad('El producto se actualizo correctamente')
          }
        }).catch(error => {
          this.errorUpdate = error.response.data.errors
        })
      })
    },
    updateProductReset: function () {
      this.product.id = 0
      this.product.subcategory.id = 0
      this.product.name = ''
      this.product.extract = ''
      this.product.description = ''
      this.product.price = ''
      this.errorUpdate = []
      this.$refs.formproductupdate.reset()
    }
  }
}

</script>
