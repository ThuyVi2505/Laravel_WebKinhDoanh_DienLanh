import axios from 'axios'

const baseDomain = `http://127.0.0.1:8000/api/`
// const baseAPI = `${baseDomain}/api/`
// api-list
//AUTH
const login = 'login'
const register = `register`
// BRAND-api
const getAll_brand = `brands`
//CATEGORY-api
const getAll_category = `categories`
//PRODUCT-api
const getAll_product = `products`
// -- end api-list
const api = axios.create({
  baseURL: baseDomain,
  headers: {
    'content-type': 'application/json'
  }
})
export { api, login, register, getAll_brand, getAll_category, getAll_product }
