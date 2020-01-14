import Vue from 'vue'
import { ValidationProvider, ValidationObserver, extend, localize, configure } from 'vee-validate'
import Paginate from 'vuejs-paginate'
import VueFileAgent from 'vue-file-agent'

// eslint-disable-next-line no-unused-vars
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css'

import es from 'vee-validate/dist/locale/es.json'
import * as rules from 'vee-validate/dist/rules'
import axios from 'axios'
import Swal from 'sweetalert2'
import { ToadAlert } from './components/helpers'

axios.defaults.headers.common['x-api-key'] = 'base64:gZG7KRmCq6ms7cDb6o9l6Kl/yd6COLu1RZ8rP8M7FeI='

Vue.prototype.$http = axios
Vue.prototype.$swal = Swal
Vue.prototype.$toad = ToadAlert
Vue.config.productionTip = false

Vue.use(VueFileAgent)

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

Vue.component('configuration-component', require('./components/Configurations/Configurations.vue').default)
Vue.component('admin-component', require('./components/Admins/Admins.vue').default)
Vue.component('user-component', require('./components/Users/Users.vue').default)
Vue.component('category-component', require('./components/Categories/Categories.vue').default)
Vue.component('subcategory-component', require('./components/SubCategories/SubCategories.vue').default)
Vue.component('product-component', require('./components/Products/Products.vue').default)
Vue.component('characteristic-component', require('./components/Characteristics/Characteristics.vue').default)
Vue.component('photo-component', require('./components/Photos/Photos.vue').default)
Vue.component('shipping-component', require('./components/Shippings/Shippings.vue').default)

Vue.component('validation-provider', ValidationProvider)
Vue.component('validation-observer', ValidationObserver)
Vue.component('paginate', Paginate)

var vm = new Vue()
vm.$mount('#wrapper')
