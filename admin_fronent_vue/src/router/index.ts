import Layout from '@/views/Layout.vue'
import Links from '@/views/Links.vue'
import Login from '@/views/Login.vue'
import Orders from '@/views/Orders.vue'
import ProductForm from '@/views/products/ProductForm.vue'
import Products from '@/views/products/Products.vue'
import Profile from '@/views/Profile.vue'
import Register from '@/views/Register.vue'
import Users from '@/views/Users.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {path: '/login', component: Login},
    {path: '/register', component: Register},
    {
      path: '',
      component: Layout,
      children: [
          {path: '', redirect: '/users'},
          {path: '/users', component: Users},
          {path: '/users/:id/links', component: Links},
          {path: '/products', component: Products},
          {path: '/products/create', component: ProductForm},
          {path: '/products/:id/edit', component: ProductForm},
          {path: '/orders', component: Orders},
          {path: '/profile', component: Profile},
      ]
    }
  ]
})

export default router
