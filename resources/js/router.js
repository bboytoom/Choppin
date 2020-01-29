import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export default new VueRouter({
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('./views/ShoppingCart/Index.vue')
    },
    {
      path: '/contacto',
      name: 'contact',
      component: () => import('./views/ShoppingCart/Contact.vue')
    },
    {
      path: '/carrito',
      name: 'shopping',
      component: () => import('./views/ShoppingCart/Cart.vue')
    },
    {
      path: '/login',
      name: 'authuser',
      component: () => import('./views/ShoppingCart/AuthUser')
    }
  ]
})
