import Vue from 'vue'
import Swal from 'sweetalert2'
import { ToadAlert } from './helpers'

Vue.prototype.$swal = Swal
Vue.prototype.$toad = ToadAlert
