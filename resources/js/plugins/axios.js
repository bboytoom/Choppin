import Vue from 'vue'
import axios from 'axios'

axios.defaults.headers.common['x-api-key'] = 'base64:S3b5iV+5DscoG4iHXTMPqTrmfqEF6P3i1rQ2xyolYkk='
axios.defaults.headers.post['Content-Type'] = 'application/json'
axios.defaults.baseURL = '/api/v1'

Vue.prototype.$http = axios
