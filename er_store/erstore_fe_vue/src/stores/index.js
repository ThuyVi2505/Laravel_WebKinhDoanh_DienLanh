import { defineStore } from 'pinia'

export const useShopCartStore = defineStore('cartstore', {
  state: () => {
    return {
      cartItems: []
    }
  },
  getters: {
    countCartItems() {
      return this.cartItems.length
    },
    totalCartItems() {
      return this.cartItems
        .reduce((acc, item) => (acc += item.sale_price * item.quantity), 0)
        .toLocaleString('vi-VN')
    },
    getCartItems() {
      return this.cartItems
    }
  },
  actions: {
    addToCart(item) {
      let index = this.cartItems.findIndex((product) => product.id === item.id)
      if (index !== -1) {
        this.cartItems[index].quantity += 1
      } else {
        item.quantity = 1
        this.cartItems.push(item)
      }

      console.log(this.cartItems)
    },
    incrementQ(item) {
      let index = this.cartItems.findIndex((product) => product.id === item.id)

      this.cartItems[index].quantity += 1
    },
    decrementQ(item) {
      let index = this.cartItems.findIndex((product) => product.id === item.id)
      this.cartItems[index].quantity -= 1
      if (this.cartItems[index].quantity == 0) {
        this.removeFromCart(item)
      }
    },
    removeFromCart(item) {
      this.cartItems = this.cartItems.filter((product) => product.id !== item.id)
    },
    removeAll() {
      this.cartItems = []
    }
  }
})
