import Vue from 'vue'
import { ValidationProvider, ValidationObserver, extend, localize, configure } from 'vee-validate'
import Paginate from 'vuejs-paginate'
import es from 'vee-validate/dist/locale/es.json'
import * as rules from 'vee-validate/dist/rules'
import axios from 'axios'
import Swal from 'sweetalert2'
import { ToadAlert } from './components/helpers'

axios.defaults.headers.common.APP_KEY = ''

Vue.prototype.$http = axios
Vue.prototype.$swal = Swal
Vue.prototype.$toad = ToadAlert

Vue.filter('capitalize', function (value) {
  if (!value) {
    return ''
  }

  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
})

Object.keys(rules).forEach(rule => {
  extend(rule, rules[rule])
})

localize('es', es)

extend('password', {
  params: ['target'],

  validate (value, { target }) {
    return value === target
  },
  message: 'Las contraseñas no coinciden'
})

configure({
  inputclass: {
    valid: 'is-valid',
    invalid: 'is-invalid'
  }
})

Vue.component('admin-component', require('./components/Admins/Admins.vue').default)
Vue.component('user-component', require('./components/Users/Users.vue').default)
Vue.component('category-component', require('./components/Categories/Categories.vue').default)
Vue.component('subcategory-component', require('./components/SubCategories/SubCategories.vue').default)
Vue.component('product-component', require('./components/Products/Products.vue').default)
Vue.component('characteristic-component', require('./components/Characteristics/Characteristics.vue').default)
Vue.component('shipping-component', require('./components/Shippings/Shippings.vue').default)

Vue.component('validation-provider', ValidationProvider)
Vue.component('validation-observer', ValidationObserver)
Vue.component('paginate', Paginate)

Vue.config.productionTip = false

var vm = new Vue()
vm.$mount('#wrapper')
