import Vue from 'vue'
import axios from 'axios'

axios.defaults.headers.common['x-api-key'] = 'base64:Ge87S+//r8gh4lFVc1RP4qg7bkjwoyY3uWsoPj79KPI='
axios.defaults.headers.post['Content-Type'] = 'application/json'
axios.defaults.baseURL = '/api/v1'

Vue.prototype.$http = axios
