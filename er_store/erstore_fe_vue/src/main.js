import './assets/css/main.css'
import 'bootstrap'
// import 'bootstrap/dist/css/bootstrap.min.css'
// import './assets/js/plugins/slick.js'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
// import store from './stores'
import { FontAwesomeIcon } from './plugins/font-awesome'

import App from './App.vue'
import router from './router'

const app = createApp(App)

// app.config.globalProperties.$http = axios
app.use(createPinia())
// app.use(store)
app.use(router).component('font-awesome-icon', FontAwesomeIcon)

app.mount('#app')
