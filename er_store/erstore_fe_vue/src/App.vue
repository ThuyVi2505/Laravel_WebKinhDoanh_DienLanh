<script setup>
import { RouterView } from 'vue-router'
</script>
<script>
import { HeaderPrimary, FooterPrimary, RegisterLetter } from '@/components'
export default {
  name: 'App',
  components: {
    HeaderPrimary,
    FooterPrimary,
    RegisterLetter
  }
}
</script>

<template>
  <!-- --header-- -->
  <HeaderPrimary />
  <!-- --end header-- -->
  <!-- main content -->
  <main><RouterView /></main>
  <!-- --end main content-- -->
  <!-- footer -->
  <RegisterLetter />
  <FooterPrimary />
  <!-- end footer -->
</template>

<style scoped>
</style>
