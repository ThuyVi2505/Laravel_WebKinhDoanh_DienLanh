import './assets/css/main.css'
import 'bootstrap'
import './assets/js/plugins/slick.js'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import store from './stores/index'
import App from './App.vue'
import router from './router'

const app = createApp(App)

// app.config.globalProperties.$http = axios
app.use(createPinia())
app.use(router)
app.use(store)

app.mount('#app')
