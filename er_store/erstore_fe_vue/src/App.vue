<script setup>
import { RouterView } from 'vue-router'
// import HeaderPrimary from './components/Header-primary.vue'
</script>

<template>
  <!-- --header-- -->
  <!-- <HeaderPrimary /> -->
  <RouterView name="header" />
  <RouterView name="top_slider" />
  <RouterView name="product_tab" />
  <!-- --end header-- -->
  <!-- main content -->
  <RouterView />

  <RouterView name="register_letters" />
  <RouterView name="footer" />
  <!-- --end main content-- -->
</template>

<style scoped>
</style>
