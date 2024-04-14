<template>
  <li class="position-static">
    <a href="#">Thương hiệu <i class="fi-rs-angle-down"></i></a>
    <ul class="mega-menu row-cols-8 menu-show">
      <menuBrandItem v-for="brand in brandList" :key="brand.id" :brand="brand" />
    </ul>
    <ul v-if="!brandList.length" class="mega-menu row-cols-8 menu-show">
      Chưa có Thương hiệu nào
    </ul>
  </li>
</template>
<script setup>
import menuBrandItem from './menuItem.vue'
const { brandList } = defineProps({
  brandList: {
    required: true,
    type: Array
  }
})
</script>

<style scoped>
.menu-show {
  background-color: #ffffef !important;
  box-shadow: 1px 1px 5px #e3e5e5;
}
</style>
