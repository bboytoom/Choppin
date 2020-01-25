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

          <modalProductForm :product="product" :categories="categories" />

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
      errorCreate: []
    }
  },
  methods: {
    createProductSubmit: function (product) {
      var data = {
        subcategory_id: this.product.subcategory.id,
        name: product.name.toLowerCase(),
        extract: product.extract.toLowerCase(),
        description: product.description.toLowerCase(),
        price: product.price,
        status: 1
      }

      this.$refs.formproductcreate.validate().then(success => {
        if (!success) {
          return
        }

        this.$http.post('/products/', data).then((response) => {
          if (response.status === 201) {
            $('#createProduct').modal('hide')

            this.index(this.state)
            this.createProductReset()

            this.$toad.toad('El producto se agrego correctamente')
          }
        }).catch(error => {
          this.errorCreate = error.response.data.errors.category_id
        })
      })
    },
    createProductReset: function () {
      this.product.id = 0
      this.product.subcategory.id = 0
      this.product.name = ''
      this.product.extract = ''
      this.product.description = ''
      this.product.price = ''
      this.errorCreate = []
      this.$refs.formproductcreate.reset()
    }
  }
}

</script>
