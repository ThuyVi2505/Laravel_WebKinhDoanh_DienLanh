<template>
  <div class="page-header breadcrumb-wrap">
    <div class="container">
      <div class="breadcrumb">
        <router-link :to="{ name: 'home' }" rel="nofollow">Trang chủ</router-link>
        <!-- <a href="index.html" rel="nofollow">Home</a> -->
        <span></span>
        <a style="pointer-events: none">{{ slug }}</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['slug', 'id'],
  data() {
    return {
      productDetail: null
    }
  }
}
</script>

<style>
</style>