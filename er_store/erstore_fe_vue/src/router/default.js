import { HomeView, LoginView, RegisterView, ProductDetailView, CartView } from '../views'
import { LayoutDefault } from '../views/layouts'

export default {
  path: '/',
  component: LayoutDefault,
  children: [
    { path: '', name: 'home', component: HomeView },
    { path: 'login', name: 'login', component: LoginView },
    { path: 'register', name: 'register', component: RegisterView },
    {
      path: 'product/:id(\\d+)/:slug',
      name: 'ProductDetailView',
      component: ProductDetailView
      // props: true
    },
    { path: 'product/cart', name: 'ProductCart', component: CartView }
  ]
}
