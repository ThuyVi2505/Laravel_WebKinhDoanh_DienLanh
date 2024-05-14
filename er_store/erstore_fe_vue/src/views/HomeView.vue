<script setup>
import { onMounted, onUnmounted } from 'vue'
//services
import useProduct from '../services/productServices'
import useCategory from '../services/categoryServices'
const { categoryList, getAllCategory, isHaveChild } = useCategory()
const { prodList, getAllProduct } = useProduct()
onMounted(() => {
  getAllCategory()
  getAllProduct()
  isHaveChild()
})
onUnmounted(() => {
  categoryList.value = []
  prodList.value = []
})

// console.warn(brandList)
</script>
<script>
import { HomeSlider, InfoSaleTrans, SaleProduct, ProductHomeCategory } from '@/components'

export default {
  name: 'HomeView',
  components: {
    InfoSaleTrans,
    HomeSlider,
    SaleProduct,
    ProductHomeCategory
    /*--*/
  }
}
</script>

<template>
  <main>
    <section class="home-banner">
      <HomeSlider />
    </section>
    <section class="info-sale-trans">
      <InfoSaleTrans />
    </section>
    <section class="sale-product container">
      <SaleProduct :prodList="prodList" />
    </section>
    <section class="product-item-category container" v-for="cat in categoryList" :key="cat.id">
      <div v-if="cat.parent_id === 0 && isHaveChild(cat)">
        <h3
          class="px-5 py-3 text-white text-uppercase"
          style="
            background-color: #008080;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
          "
        >
          {{ cat.cat_name }}
        </h3>
        <ProductHomeCategory :category_id="cat.id" class="px-5 py-3" />
      </div>
    </section>
  </main>
</template>
<style scoped>
.home-banner {
  width: 100%;
}
.info-sale-trans,
.small-banner-top,
.sale-product,
.container {
  background-color: #fff;
}
.small-banner-top,
.sale-product,
.container {
  padding: 0;
  margin-top: 20px;
  border-radius: 10px;
  box-shadow: 1px 2px 4px #d8d2d2;
}
</style>
