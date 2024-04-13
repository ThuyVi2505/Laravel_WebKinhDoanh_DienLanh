<script>
import { HomeSlider } from '@/components'
import ProductTab from '@/components/ProductTab.vue'
export default {
  name: 'HomeView',
  components: {
    HomeSlider,
    ProductTab
  }
}
</script>

<template>
  <main>
    <section class="home-banner container">
      <HomeSlider />
    </section>
    <section class="under-banner container">
      <div style="height: 80px; background-color: aqua"></div>
    </section>
    <section><h1>Top Slider banner</h1></section>
    <section><ProductTab /></section>
  </main>
</template>
<style scoped>
</style>
