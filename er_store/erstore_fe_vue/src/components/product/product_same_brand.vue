<template>
  <div class="sale-product-items">
    <div class="sale-product-items-top">
      <div class="d-flex align-items-center">
        <p>CÙNG THƯƠNG HIỆU</p>
      </div>
    </div>
    <div class="sale-product-items-bottom">
      <div class="tab-header mt-3 mb-2 mx-5">
        <ul
          class="nav nav-tabs"
          style="opacity: 0; pointer-events: none"
          id="myTab"
          role="tablist"
          disabled
        ></ul>
        <a href="#" class="view-more">Xem tất cả<i class="fi-rs-angle-double-small-right"></i></a>
      </div>
      <div class="tab-content wow fadeIn animated px-5 mt-0" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="tab-one"
          role="tabpanel"
          aria-labelledby="tab-one"
        >
          <div
            class="row product-grid-4 row-cols-2 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2"
          >
            <product-item
              v-for="prod in prodList
                .filter(
                  (product) =>
                    product.brand.id === prodDetail?.brand?.id && product.id != prodDetail?.id
                )
                .sort((b, a) => a.id - b.id)
                .slice(0, 5)"
              v-bind:key="prod.id"
              :prod="prod"
            ></product-item>
          </div>
          <!--End product-grid-4-->
        </div>
      </div>
    </div>
  </div>
</template>
  <script setup>
import productItem from './product_item.vue'
const { prodList, prodDetail } = defineProps({
  prodList: {
    required: true,
    type: Array
  },
  prodDetail: {
    required: true,
    type: Object
  }
})
// import { onMounted } from 'vue'
// import { useProductStore } from '@/stores/product.store'
// // import { useRouter } from 'vue-router'

// const store = useProductStore()
// // const router = useRouter()

// // const search = ref('')

// // const goToProductPage = (id) => {
// //   router.push({ name: 'ProductView', params: { id } })
// // }

// onMounted(async () => {
//   await store.fetchProducts()
// })

// import useProduct from '../services/productServices'
// import { onMounted } from 'vue'
// const { prodList, getAllProduct } = useProduct()
// onMounted(getAllProduct)
</script>
  <script>
import { defineComponent } from 'vue'

export default defineComponent({})
</script>
  
  <style scoped>
/* .sale-product-items {
  } */
.sale-product-items-top {
  height: 60px;
  /* background-image: url('../../assets/imgs/banner/bg-banner1.png'); */
  background-color: #008080;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.sale-product-items-top p {
  margin: 0 5px 0 5px;
  font-size: 25px;
  color: white;
  font-weight: bolder;
}

.tab-header a {
  font-size: 16px;
}
.sale-product-items-bottom {
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
}
</style>