import Vue from 'vue'
import VueRouter from 'vue-router'
import Index from '../components/Store/Index/Index.vue'
import Contact from '../components/Store/Contact/Contact.vue'
import Shopping from '../components/Store/Shopping/Shopping.vue'
import ProductsShow from '../components/Store/Products/ProductsShow.vue'

Vue.use(VueRouter)

export default new VueRouter({
  routes: [
    { path: '/', component: Index },
    { path: '/product/:slug/:id', component: ProductsShow },
    { path: '/contacto', component: Contact },
    { path: '/shopping', component: Shopping }
  ]
})
