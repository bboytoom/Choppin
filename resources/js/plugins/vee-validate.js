import Vue from 'vue'
import { ValidationProvider, ValidationObserver, extend, localize, configure } from 'vee-validate'
import es from 'vee-validate/dist/locale/es.json'
import * as rules from 'vee-validate/dist/rules'

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

Vue.component('validation-provider', ValidationProvider)
Vue.component('validation-observer', ValidationObserver)
