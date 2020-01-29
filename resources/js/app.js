import Vue from 'vue'
import router from './router'
import store from './store'

require('./plugins/')

Vue.config.productionTip = false

Vue.filter('capitalize', function (value) {
  if (!value) {
    return ''
  }

  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
})

Vue.component('admin-component', require('./views/Administrator/Admins.vue').default)
Vue.component('category-component', require('./views/Administrator/Categories.vue').default)
Vue.component('characteristic-component', require('./views/Administrator/Characteristics.vue').default)
Vue.component('configuration-component', require('./views/Administrator/Configurations.vue').default)
Vue.component('gallery-component', require('./views/Administrator/Galleries.vue').default)
Vue.component('photo-gallery-component', require('./views/Administrator/PhotoGallery.vue').default)
Vue.component('photo-component', require('./views/Administrator/Photos.vue').default)
Vue.component('photo-slide-component', require('./views/Administrator/PhotoSlide.vue').default)
Vue.component('product-component', require('./views/Administrator/Products.vue').default)
Vue.component('shipping-component', require('./views/Administrator/Shippings.vue').default)
Vue.component('subcategory-component', require('./views/Administrator/SubCategories.vue').default)
Vue.component('user-component', require('./views/Administrator/Users.vue').default)

Vue.component('admin-component', require('./views/Admin/Admin.vue').default)
Vue.component('store-component', require('./views/ShoppingCart/ShoppingCart.vue').default)

const vm = new Vue({
  router,
  store
})

vm.$mount('#wrapper')
