import { api, getAll_brand } from './apiBaseSetup'
import { ref } from 'vue'
export default function useBrand() {
  const brandList = ref([])
  // Get All Students Data
  const getAllBrand = async () => {
    brandList.value = []
    try {
      const res = await api.get(getAll_brand)
      // console.log(res.data)
      brandList.value = res.data.data
    } catch (err) {
      console.log(err)
    }
  }
  return {
    brandList,
    getAllBrand
  }
}
