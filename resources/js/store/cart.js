import { find, filter } from 'lodash'
import generateHash from 'random-hash'

const state = {
  identity: generateHash({ length: 64 }),
  cart: []
}

const getters = {
  totalCost: function (state) {
    return state.cart.reduce((sum, product) => {
      return (parseFloat(product.attributes.price) * product.qty) + sum
    }, 0)
  },
  totalProducts: function (state) {
    return state.cart.reduce((sum, product) => {
      return sum + product.qty
    }, 0)
  }
}

const mutations = {
  addProduct: function (state, product) {
    const productInCart = find(state.cart, { id: product.id })

    if (!productInCart) {
      const copy = Object.assign({}, product)

      copy.qty = 1
      state.cart.push(copy)
    } else {
      productInCart.qty++
    }
  },
  removeProductFromCart: function (state, product) {
    state.cart = filter(state.cart, ({ id }) => id !== product.id)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations
}
