<script setup>
</script>

<template>
  <main>
    <div class="container pt-20">
      <router-link :to="{ name: 'home' }"
        ><font-awesome-icon icon="chevron-left" /> Quay lại trang chính</router-link
      >
    </div>
    <div class="d-flex justify-content-center align-items-center p-20"><h1>NOT FOUND 404</h1></div>
  </main>
</template>

<style scoped>
a {
  color: #3984e3 !important;
  font-size: 20px;
}
a:hover {
  color: #f15412 !important;
}
</style>
