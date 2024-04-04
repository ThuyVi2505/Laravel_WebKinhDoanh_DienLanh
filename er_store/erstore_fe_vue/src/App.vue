<script setup>
import { RouterView } from 'vue-router'
// import HeaderPrimary from './components/Header-primary.vue'
</script>

<template>
  <!-- --header-- -->
  <!-- <HeaderPrimary /> -->
  <RouterView name="header" />
  <!-- --end header-- -->
  <!-- main content -->
  <RouterView />
  <!-- --end main content-- -->
</template>

<style scoped>
</style>
