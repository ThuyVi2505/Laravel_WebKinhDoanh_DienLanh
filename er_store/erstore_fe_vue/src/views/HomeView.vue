<script>
import { HomeSlider, InfoSaleTrans, SaleProduct, SmallBannerTop } from '@/components'
import ProductTab from '@/components/ProductTab.vue'
export default {
  name: 'HomeView',
  components: {
    InfoSaleTrans,
    HomeSlider,
    SaleProduct,
    SmallBannerTop,
    ProductTab
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
      <SaleProduct />
    </section>
    <section class="small-banner-top container">
      <SmallBannerTop />
    </section>
    <!-- <section><h1>Top Slider banner</h1></section> -->
    <section><ProductTab /></section>
  </main>
</template>
<style scoped>
.home-banner {
  width: 100%;
}
.info-sale-trans,
.small-banner-top,
.sale-product {
  background-color: #fff;
}
.small-banner-top,
.sale-product {
  padding: 0;
  margin-top: 20px;
  border-radius: 10px;
  box-shadow: 1px 2px 4px #d8d2d2;
}
</style>
