window.Vue = require('vue');
window.axios = require('axios');
window.Swal = require('sweetalert2');
window.Paginate = require('vuejs-paginate')

import { ValidationProvider, ValidationObserver, extend, localize, configure } from 'vee-validate';
import es from 'vee-validate/dist/locale/es.json';
import * as rules from 'vee-validate/dist/rules';

Object.keys(rules).forEach(rule => {
  extend(rule, rules[rule]);
});

localize('es', es);

extend('password', {
  params: ['target'],
  validate(value, {
    target
  }) {
    return value === target;
  },
  message: 'Las contraseñas no coinciden'
});

configure({
  inputclass: {
    valid: 'is-valid',
    invalid: 'is-invalid'
  }
});

Vue.filter('capitalize', function (value) {
  if (!value) {
    return '';
  }
  
  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
});

//Componentes del sistema
Vue.component('admin-component', require('./components/Admins/Admins.vue').default);
Vue.component('user-component', require('./components/Users/Users.vue').default);

//Librerias
Vue.component('validation-provider', ValidationProvider);
Vue.component('validation-observer', ValidationObserver);
Vue.component('paginate', Paginate)

Vue.config.productionTip = false;

new Vue({ el: '#wrapper' });
