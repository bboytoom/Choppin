import axios from 'axios'

const state = {
  slides: [],
  categories: [],
  products: []
}

const mutations = {
  setShop: function (state, myData) {
    state.slides = myData.slide
    state.categories = myData.categories
    state.products = myData.data
  }
}

const actions = {
  productList: async function ({ commit }) {
    try {
      const myData = await axios.get('/store')
      commit('setShop', myData.data)
    } catch (error) {
      console.log(error)
    }
  }
}

const getters = {

}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
