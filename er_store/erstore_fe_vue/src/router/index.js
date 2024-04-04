import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'

import NotFound from '../views/NotFound.vue'

import HeaderPrimary from '../components/Header-primary.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/:pathMatch(.*)*',
      name: 'notfound',
      components: { default: NotFound, header: HeaderPrimary }
    },
    {
      path: '/',
      name: 'home',
      components: { default: HomeView, header: HeaderPrimary }
    },
    {
      path: '/login',
      name: 'login',
      components: { default: LoginView, header: HeaderPrimary }
    },
    {
      path: '/login',
      name: 'register',
      components: { default: RegisterView, header: HeaderPrimary }
    }
  ]
})

export default router
