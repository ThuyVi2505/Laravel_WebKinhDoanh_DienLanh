import { HomeView, LoginView, RegisterView, ProductDetailView } from '../views'
import { LayoutDefault } from '../views/layouts'

export default {
  path: '/',
  component: LayoutDefault,
  children: [
    { path: '', name: 'home', component: HomeView },
    { path: 'login', name: 'login', component: LoginView },
    { path: 'register', name: 'register', component: RegisterView },
    { path: 'product/:slug:id', name: 'ProductDetail', component: ProductDetailView, props: true }
  ]
}
