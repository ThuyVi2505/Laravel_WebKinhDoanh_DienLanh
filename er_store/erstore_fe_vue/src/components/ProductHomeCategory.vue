<template>
  <div class="product-home-category-items">
    <div class="tab-header mt-3 mb-2">
      <ul
        class="nav nav-tabs"
        style="opacity: 0; pointer-events: none"
        id="myTab"
        role="tablist"
        disabled
      ></ul>
      <a href="#" class="view-more">Xem tất cả<i class="fi-rs-angle-double-small-right"></i></a>
    </div>
    <div class="tab-content wow fadeIn animated px-2 mt-0" id="myTabContent">
      <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
        <div
          class="row product-grid-4 row-cols-2 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2"
        >
          <product-item
            v-for="prod in prodListCategory
              // .filter((product) => product.sale_percent !== 0)
              .sort((b, a) => a.created_at - b.created_at)
              .slice(0, 10)"
            v-bind:key="prod.id"
            :prod="prod"
          ></product-item>
        </div>
        <!--End product-grid-4-->
      </div>
    </div>
    <!-- <div class="" v-for="prod in prodListCategory" :key="prod.id"></div> -->
  </div>
</template>

<script>
</script>
<script setup>
import productItem from '../components/product/product_item.vue'
import useProduct from '@/services/productServices'
import { onMounted, onUnmounted } from 'vue'
// import productItem from '../components/product/product_item.vue'
const { category_id } = defineProps({
  category_id: {
    required: true,
    type: Number
  }
})
//get store
const { prodListCategory, getProductByCategory } = useProduct()
onMounted(() => {
  getProductByCategory(category_id)
  console.log(prodListCategory)
})
onUnmounted(() => {
  prodListCategory.value = []
})
</script>

<style>
</style>