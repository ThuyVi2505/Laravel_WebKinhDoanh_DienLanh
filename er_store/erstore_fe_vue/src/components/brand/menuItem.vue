<template>
  <li>
    <a href="/a"><img :src="brand.thumnail" alt="" /></a>
  </li>
</template>
<script setup>
const { brand } = defineProps({
  brand: {
    required: true,
    type: Object
  }
})
</script>
<style scoped>
li a img:hover {
  background: white;
  border: 1px solid #ff6f00;
  box-shadow: 1px 2px 5px #e3e5e5;
}
li a img {
  border-radius: 5px;
  padding: 10px;
}
</style>