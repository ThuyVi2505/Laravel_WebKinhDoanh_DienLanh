<script setup>
import { onMounted, onUnmounted } from 'vue'
//services
import useProduct from '../services/productServices'
const { prodList, getAllProduct } = useProduct()
onMounted(() => {
  getAllProduct()
})
onUnmounted(() => {
  prodList.value = []
})

// console.warn(brandList)
</script>
<script>
import { HomeSlider, InfoSaleTrans, SaleProduct, SmallBannerTop, ProductTab } from '@/components'
export default {
  name: 'HomeView',
  components: {
    InfoSaleTrans,
    HomeSlider,
    SaleProduct,
    SmallBannerTop,
    ProductTab
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
    <section class="small-banner-top container">
      <SmallBannerTop />
    </section>
    <!-- <section><h1>Top Slider banner</h1></section> -->
    <section class="product-tab container">
      <product-tab></product-tab>
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
.product-tab {
  background-color: #fff;
}
.small-banner-top,
.sale-product,
.product-tab {
  padding: 0;
  margin-top: 20px;
  border-radius: 10px;
  box-shadow: 1px 2px 4px #d8d2d2;
}
</style>
