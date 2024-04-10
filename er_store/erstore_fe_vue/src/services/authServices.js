import { api, login } from './apiBaseSetup'
export default function useAuth() {
  const loginUser = async (email, password) => {
    try {
      const res = await api.post(login, {
        email,
        password
      })
      // console.log(res.data)
      return res
    } catch (err) {
      console.log(err)
    }
  }
  return {
    loginUser
  }
}
