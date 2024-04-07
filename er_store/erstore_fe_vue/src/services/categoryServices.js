import { api, getAll_category } from './apiBaseSetup'
import { ref } from 'vue'
export default function useCategory() {
  const categoryList = ref([])
  // Get All Students Data
  const getAllCategory = async () => {
    categoryList.value = []
    try {
      const res = await api.get(getAll_category)
      // console.log(res.data.data)
      categoryList.value = res.data.data
    } catch (err) {
      console.log(err)
    }
  }
  const isHaveChild = (category) => {
    return categoryList.value.some((cat) => cat.parent_id === category.id)
  }
  const getChildCategory = (parentId) => {
    return categoryList.value.filter((cat) => cat.parent_id === parentId)
  }

  return {
    categoryList,
    getAllCategory,
    isHaveChild,
    getChildCategory
  }
}
