const state = {
  items: []
}

const mutations = {
  pushProductToCart: function (state, { id }) {
    state.items.push({ id, quantity: 1 })
  }
}

export default {
  namespaced: true,
  state,
  mutations
}
