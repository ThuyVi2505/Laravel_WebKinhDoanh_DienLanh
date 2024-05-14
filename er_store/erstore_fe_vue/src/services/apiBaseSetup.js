import axios from 'axios'

const baseDomain = `http://erstore.project.test:5000`
const baseAPI = `${baseDomain}/api/`
// api-list
// BRAND-api
const getAll_brand = `brands`
//CATEGORY-api
const getAll_category = `categories`
//PRODUCT-api
const get_product = `products`
// -- end api-list
const api = axios.create({
  baseURL: baseAPI,
  headers: { 'Content-Type': 'application/json' }
})
export { api, baseAPI, getAll_brand, getAll_category, get_product }
