import { api, getAll_product } from './apiBaseSetup'
import { ref } from 'vue'
export default function useProduct() {
  const prodList = ref([])
  // Get All Students Data
  const getAllProduct = async () => {
    prodList.value = []
    try {
      const res = await api.get(getAll_product)
      // console.log(res.data)
      prodList.value = res.data.data
    } catch (err) {
      console.log(err)
    }
  }
  return {
    prodList,
    getAllProduct
  }
}
