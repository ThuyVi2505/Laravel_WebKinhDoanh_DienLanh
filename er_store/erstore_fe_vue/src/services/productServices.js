import { api, get_product } from './apiBaseSetup'
import { ref } from 'vue'
export default function useProduct() {
  const prodList = ref([])
  const prodDetail = ref(null)
  // Get All Students Data
  const getAllProduct = async () => {
    prodList.value = []
    try {
      const res = await api.get(get_product)
      // console.log(res.data)
      prodList.value = res.data.data
    } catch (err) {
      console.log(err)
    }
  }
  // Get Single Student Data
  const getSingleProduct = async (id) => {
    prodDetail.value = null
    try {
      const res = await api.get(get_product + '/' + id)
      prodDetail.value = res.data.data
      // console.log('testt data')
    } catch (err) {
      console.log(err)
    }
  }

  return {
    prodList,
    prodDetail,
    getAllProduct,
    getSingleProduct
  }
}
