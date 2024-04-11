import { HomeView, LoginView, RegisterView } from '../views'
import { LayoutDefault } from '../views/layouts'

export default {
  path: '/',
  component: LayoutDefault,
  children: [
    { path: '', name: 'home', component: HomeView },
    { path: 'login', name: 'login', component: LoginView },
    { path: 'register', name: 'register', component: RegisterView }
  ]
}
