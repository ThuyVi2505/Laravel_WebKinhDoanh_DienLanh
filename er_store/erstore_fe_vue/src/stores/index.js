// import Vue from 'vue'
import { createStore } from 'vuex'

import authStore from './modules/authStore'

// Vue.use(Vuex)

export default createStore({
  // state: {},
  // mutations: {},
  // actions: {},
  modules: { AUTH: authStore }
})
