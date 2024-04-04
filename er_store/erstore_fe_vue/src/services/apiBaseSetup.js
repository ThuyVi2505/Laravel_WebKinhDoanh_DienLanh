import axios from 'axios'

const baseDomain = `http://127.0.0.1:8000`
const baseAPI = `${baseDomain}/api/`
// BRAND-api
const getAll_brand = `brands`
const api = axios.create({
  baseURL: baseAPI,
  headers: { 'Content-Type': 'application/json' }
})
export { api, getAll_brand }
