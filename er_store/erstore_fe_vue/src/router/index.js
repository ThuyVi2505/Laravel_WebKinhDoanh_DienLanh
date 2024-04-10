import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'

import NotFound from '../views/NotFound.vue'

import HeaderPrimary from '../components/Header-primary.vue'
import FooterPrimary from '../components/Footer-primary.vue'
import ProductTab from '../components/ProductTab.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/:pathMatch(.*)*',
      name: 'notfound',
      components: { default: NotFound, header: HeaderPrimary, footer: FooterPrimary }
    },
    {
      path: '/',
      name: 'home',
      components: {
        default: HomeView,
        product_tab: ProductTab,
        header: HeaderPrimary,
        footer: FooterPrimary
      }
    },
    {
      path: '/login',
      name: 'login',
      components: { default: LoginView, header: HeaderPrimary, footer: FooterPrimary }
    },
    {
      path: '/register',
      name: 'register',
      components: { default: RegisterView, header: HeaderPrimary, footer: FooterPrimary }
    }
  ]
})

export default router
