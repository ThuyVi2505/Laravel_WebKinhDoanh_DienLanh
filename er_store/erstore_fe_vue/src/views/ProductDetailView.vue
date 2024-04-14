<template>
  <div class="page-header breadcrumb-wrap">
    <div class="container">
      <div class="breadcrumb">
        <router-link :to="{ name: 'home' }" rel="nofollow">Trang chủ</router-link>
        <!-- <a href="index.html" rel="nofollow">Home</a> -->
        <span></span>
        <a style="pointer-events: none">{{ selectedProduct.prod_name }}</a>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
  name: 'ProductDetailView'
})
</script>
<script setup>
import { computed, onMounted } from 'vue'
import { useProductStore } from '@/stores/product.store'
import { useRoute } from 'vue-router'

const store = useProductStore()
const route = useRoute()

const selectedProduct = computed(() => {
  return store.products.find((item) => item.id === Number(route.params.id))
})
onMounted(() => {
  if (!selectedProduct.value) {
    store.fetchProducts()
  }
})
</script>


<style>
</style>