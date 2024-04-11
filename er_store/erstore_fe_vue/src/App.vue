<script setup>
import { RouterView } from 'vue-router'
// import HeaderPrimary from './components/HeaderPrimary.vue'
// import FooterPrimary from './components/FooterPrimary.vue'
// import RegisterLetter from './components/RegisterLetter.vue'
import { HeaderPrimary, FooterPrimary, RegisterLetter } from '@/components'
</script>

<template>
  <!-- --header-- -->
  <HeaderPrimary />
  <!-- <RouterView name="top_slider" /> -->
  <RouterView name="product_tab" />
  <!-- --end header-- -->
  <!-- main content -->
  <RouterView />

  <RegisterLetter />
  <FooterPrimary />
  <!-- --end main content-- -->
</template>

<style scoped>
</style>
