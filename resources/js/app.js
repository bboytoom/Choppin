/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.Swal = require('sweetalert2');
window.Paginate = require('vuejs-paginate')

import { ValidationProvider, ValidationObserver, extend, localize, configure } from 'vee-validate';
import es from 'vee-validate/dist/locale/es.json';
import * as rules from 'vee-validate/dist/rules';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

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

Vue.component('user-component', require('./components/User/Users.vue').default);
Vue.component('validation-provider', ValidationProvider);
Vue.component('validation-observer', ValidationObserver);
Vue.component('paginate', Paginate)

Vue.config.productionTip = false;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({ el: '#wrapper' });
