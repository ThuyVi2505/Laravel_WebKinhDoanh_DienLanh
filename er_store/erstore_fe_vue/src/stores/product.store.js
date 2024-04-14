import { defineStore } from 'pinia'

export const useProductStore = defineStore({
  id: 'products', // ID của store
  state: () => ({
    products: []
  }),

  actions: {
    fetchProducts() {
      fetch('http://127.0.0.1:8000/api/products')
        .then((res) => res.json())
        .then((json) => {
          this.products = json.data
        })
    }
  }
})
