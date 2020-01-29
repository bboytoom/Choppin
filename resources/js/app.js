import Vue from 'vue'
import App from './views/App.vue'

Vue.config.productionTip = false

Vue.filter('capitalize', function (value) {
  if (!value) {
    return ''
  }

  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
})

const vm = new Vue({
  render: h => h(App)
})

vm.$mount('#wrapper')
