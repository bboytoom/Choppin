import Vue from 'vue'
import axios from 'axios'

axios.defaults.headers.common['x-api-key'] = 'base64:uoB382KLuZjmVcs6igvBghnfUGTlHI+jwKZlMFClSyg='
axios.defaults.headers.post['Content-Type'] = 'application/json'
axios.defaults.baseURL = '/api/v1'

Vue.prototype.$http = axios
