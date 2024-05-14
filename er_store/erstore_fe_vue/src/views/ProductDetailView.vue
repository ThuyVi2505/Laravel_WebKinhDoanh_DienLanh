<script setup>
// import useProduct from '../services/productServices'
// // import { onMounted } from 'vue'
// import { useRoute } from 'vue-router'
// const { prodDetail, getSingleProduct, prodList, getAllProduct } = useProduct()
// const route = useRoute()
// onMounted(() => {
//   getSingleProduct(route.params.id)

//   getAllProduct()
// })
import { useShopCartStore } from '../stores'
//get store
const data = useShopCartStore()
</script>
<script>
// import axios from 'axios'
import product_detail_image from '@/components/product/product_detail_image.vue'
import product_same_brand from '@/components/product/product_same_brand.vue'
import product_detail_sub from '@/components/product/product_detail_sub.vue'
import { api } from '../services/apiBaseSetup'
export default {
  components: { product_detail_sub, product_detail_image, product_same_brand },
  data() {
    return { prodDetail: {}, prodList: [], id: '' }
  },
  watch: {
    $route() {
      this.id = this.$route.params.id

      this.getSingleProduct(this.id)

      this.getAllProduct()
    }
  },
  created() {
    this.id = this.$route.params.id
    this.getSingleProduct(this.id)

    this.getAllProduct()
  },
  methods: {
    getAllProduct() {
      api.get(`products`).then((res) => {
        this.prodList = res.data.data
      })
    },
    getSingleProduct(id) {
      api.get(`products/${id}`).then((res) => {
        this.prodDetail = res.data.data
      })
    }
  }
}
</script>

<template>
  <!-- breadcrumb -->
  <div class="page-header breadcrumb-wrap">
    <div class="container">
      <div class="breadcrumb">
        <router-link :to="{ name: 'home' }" rel="nofollow">Trang chủ</router-link>
        <!-- <a href="index.html" rel="nofollow">Home</a> -->
        <span></span>
        <a style="pointer-events: none">{{ prodDetail?.prod_name }} {{ prodDetail?.prod_model }}</a>
      </div>
    </div>
  </div>
  <!-- end breadcrumb -->
  <!-- *** PRODUCT DETAIL *** -->

  <div class="product-detail container">
    <!-- main info -->
    <div class="product-detail-main row row-cols-1 row-cols-lg-2 pt-4">
      <div class="product-detail-main-left">
        <product_detail_image :product="prodDetail"></product_detail_image>
        <!-- <div class="thumb-product"><img v-bind:src="prodDetail?.images[0]" alt="" /></div> -->
      </div>
      <div class="product-detail-main-right">
        <div class="product-brand text-uppercase">{{ prodDetail?.brand?.name }}</div>
        <div class="product-name">
          <p>{{ prodDetail?.prod_name }} {{ prodDetail?.prod_model }}</p>
        </div>
        <div class="product-star">
          <font-awesome-icon icon="star" class="checked" />
          <font-awesome-icon icon="star" class="checked" />
          <font-awesome-icon icon="star" class="checked" />
          <font-awesome-icon icon="star" class="checked" />
          <font-awesome-icon icon="star" />
        </div>
        <div class="saled">Đã bán: 200</div>
        <hr class="m-0" />
        <div class="product-price mt-30">
          <div class="sale-price mt-2">
            <p>{{ prodDetail?.sale_price?.toLocaleString('vi-VN') }} &#8363;</p>
          </div>
          <div v-if="prodDetail?.sale_percent != 0" class="current-price">
            <span class="percent">- {{ prodDetail?.sale_percent }}%</span>
            <p class="price">{{ prodDetail?.prod_price?.toLocaleString('vi-VN') }} &#8363;</p>
          </div>
          <div v-else style="height: 30px"></div>
        </div>
        <div class="product-button mt-20 row">
          <div class="check-out col-7"><button class="w-100">Mua ngay</button></div>
          <div class="add-cart col-5">
            <button class="w-100" @click="data.addToCart(prodDetail)">Thêm vào giỏ hàng</button>
          </div>
        </div>
        <div class="fw-bold text-center" style="font-size: 16px; margin: 20px 0 20px 0">
          Gọi đặt mua tại<a href="tel: (+1) 0000-000-000" class="mx-1">(+1) 0000-000-000</a>(07 -
          17h trong ngày)
        </div>
      </div>
    </div>
    <!-- end main info -->
    <hr class="px-0 mx-0" />
    <!-- more info -->
    <div class="product-detail-submain">
      <product_detail_sub :prodDetail="prodDetail"></product_detail_sub>
    </div>
    <!-- end more info -->
  </div>
  <!-- *** END PRODUCT DETAIL *** -->

  <!-- product similar brand -->
  <div class="product-same-brand container">
    <product_same_brand :prodList="prodList" :prodDetail="prodDetail"></product_same_brand>
  </div>
  <!-- end product simila brand-->
</template>

<style scoped>
.page-header {
  background-color: #ebe8e2;
  font-size: 1rem;
}
.page-header a {
  font-size: 1rem;
}
.product-detail {
  background-color: #fff;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
  padding: 5px 2px 10px 2px;
}
.thumb-product {
  background-color: #fff;
  width: 100%;
}
.product-detail-main {
  padding: 0 5px 0 5px;
}
.product-detail-main-right .product-name p {
  color: #008080;
  text-transform: uppercase;
  font-size: 20px;
  font-weight: bold;
}
.product-detail-main-right {
  padding: 10px 20px 10px 20px;
}
.product-star {
  margin-top: 0.5em;
}
.product-star svg {
  font-size: 16px;
  color: rgb(217, 218, 220);
}
.product-star .checked {
  color: rgb(255, 191, 0);
}
.product-price .sale-price p {
  color: #7c2e04;
  font-weight: 600;
  font-size: 30px;
}
.product-price .current-price {
  margin-top: 10px;
  display: flex;
}
.product-price .current-price .price {
  padding: 3px 5px 0 5px;
  font-size: 16px;
  color: #878482;

  text-decoration: line-through;
}
.product-price .current-price .percent {
  border-radius: 10px;
  color: red;
  padding: 3px 5px 0 5px;
  font-size: 16px;
  font-weight: 600;
  text-align: center;
}
.product-button {
  padding: 5px 0 5px 0;
}
.product-button button {
  height: 50px;
  font-weight: bold;
  text-transform: uppercase;
  border-width: 3px;
  border-radius: 10px;
  font-size: 16px;
}
.product-button div.add-cart button {
  background-color: #fff;
  border-color: rgb(255, 77, 0) !important;
  color: rgb(255, 77, 0);
}
.product-button div.add-cart button:hover {
  color: #fff;
  border-color: rgb(255, 77, 0) !important;
  background-color: rgb(255, 77, 0);
}
.product-button .check-out button {
  background-color: rgb(3, 153, 36);
  border-color: rgb(3, 153, 36);
  color: #fff;
  opacity: 0.7;
}
.product-button .check-out button:hover {
  opacity: 1;
}
/* productt same brand */
.product-same-brand {
  background-color: #fff;
}
.product-same-brand {
  padding: 0;
  margin-top: 20px;
  border-radius: 10px;
  box-shadow: 1px 2px 4px #d8d2d2;
}
</style>