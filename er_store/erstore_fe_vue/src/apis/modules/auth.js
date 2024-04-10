import api from '../../apis'

export default function useAuth() {
  const loginUser = (email, password) => {
    const res = api().post('/login', {
      email,
      password
    })
    // console.log(res.data)
    return res
  }
  return {
    loginUser
  }
}
