import Vue from 'vue'
import axios from 'axios'

axios.defaults.headers.common['x-api-key'] = 'base64:tEEV+7x2pORfXaE/rn6U9HHU7RlGt4HXk1IPsQKFnO4='
axios.defaults.headers.post['Content-Type'] = 'application/json'
axios.defaults.baseURL = '/api/v1'

Vue.prototype.$http = axios
