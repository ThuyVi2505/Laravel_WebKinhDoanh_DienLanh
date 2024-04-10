import useAuth from '../../apis/modules/auth'
const { loginUser } = useAuth()

const states = {}
const getters = {}
const mutations = {
  DO_THING() {
    console.log('Do things')
  }
}
const actions = {
  async login({ commit }, credentials) {
    try {
      const response = await loginUser(credentials.email, credentials.password)
      console.log(response.data)
      commit('DO_THING')
    } catch (error) {
      console.log(error.response)
    }
  }
}

export default {
  namespaced: true,
  states,
  getters,
  mutations,
  actions
}
