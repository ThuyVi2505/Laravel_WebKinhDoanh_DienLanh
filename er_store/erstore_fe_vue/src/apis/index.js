import axios from 'axios'
// axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
const baseDomain = `http://127.0.0.1:8000/api/`

export default () => {
  return axios.create({ baseURL: baseDomain })
}
