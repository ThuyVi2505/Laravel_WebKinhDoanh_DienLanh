import { createRouter, createWebHistory } from 'vue-router'
// import HomeView from '../views/HomeView.vue'
// import LoginView from '../views/LoginView.vue'
// import RegisterView from '../views/RegisterView.vue'
import defaultRoutes from './default'
import NotFound from '../views/NotFound.vue'

// import ProductTab from '../components/ProductTab.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/:pathMatch(.*)*',
      name: 'notfound',
      component: NotFound
    },
    { ...defaultRoutes }
  ]
})
// Tạo một global navigation guard
router.beforeEach((to, from, next) => {
  // Cuộn lên đầu trang mới khi chuyển hướng

  window.scrollTo(0, 0)
  // Chuyển tiếp đến route tiếp theo
  next()
})
export default router
