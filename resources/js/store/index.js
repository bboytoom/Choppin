import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersistence from 'vuex-persist'
import cart from './cart'
import shop from './shop'

Vue.use(Vuex)

const vuexLocal = new VuexPersistence({
  storage: window.localStorage,
  modules: ['cart']
})

export default new Vuex.Store({
  modules: {
    cart,
    shop
  },
  plugins: [vuexLocal.plugin]
})
