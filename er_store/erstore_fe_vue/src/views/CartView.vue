<script setup>
import { useShopCartStore } from '../stores'
//get store
const data = useShopCartStore()
</script>
<template>
  <div class="page-header breadcrumb-wrap">
    <div class="container">
      <div class="breadcrumb">
        <router-link :to="{ name: 'home' }" rel="nofollow">Trang chủ</router-link>
        <!-- <a href="index.html" rel="nofollow">Home</a> -->
        <span></span>
        <a style="pointer-events: none">Giỏ hàng</a>
      </div>
    </div>
  </div>
  <div class="container null-cart text-uppercase" v-if="data.getCartItems.length <= 0">
    <p class="fw-bold" style="color: #008080">Giỏ hàng đang trống</p>
    <img src="../assets/imgs/logo/null_cart.jpg" alt="" />
  </div>
  <div class="container cart">
    <div class="shopping mb-5">
      <router-link
        :to="{ name: 'home' }"
        class="btn btn-sm bg-primary border-0 mb-2 continue-shopping"
      >
        Tiếp tục mua sắm
      </router-link>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Tên mặt hàng</th>
          <th scope="col" class="text-center">Đơn giá (&#8363;)</th>
          <th scope="col" class="text-center">Số lượng</th>
          <th scope="col" class="text-center">Tạm tính (&#8363;)</th>
          <th scope="col" class="text-center"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data.getCartItems" :key="item.id">
          <td>
            <div class="d-flex align-items-center">
              <div class="img mx-5" style="width: 80px; height: 80px">
                <img :src="item.images[0]" alt="" style="object-fit: contain" />
              </div>
              <div class="name text-uppercase">
                <router-link
                  class="fw-bold"
                  :to="{
                    name: 'ProductDetailView',
                    params: { id: item.id, slug: item.prod_slug }
                  }"
                  >{{ item.prod_name }}</router-link
                >
              </div>
            </div>
          </td>
          <td class="text-center">
            <p class="price">
              {{ item.sale_price.toLocaleString('vi-VN') }}
              <span class="text-danger ms-1" v-if="item.sale_percent > 0">
                (-{{ item.sale_percent }}%)</span
              >
            </p>
          </td>
          <td class="text-center">
            <div class="quantity d-flex justify-content-center align-items-center">
              <a @click="data.decrementQ(item)"><font-awesome-icon icon="square-minus" /></a>
              <p class="mx-3">{{ item.quantity }}</p>
              <a @click="data.incrementQ(item)"><font-awesome-icon icon="square-plus" /></a>
            </div>
          </td>

          <td class="text-center">
            <p>{{ (item.quantity * item.sale_price).toLocaleString('vi-VN') }}</p>
          </td>
          <td class="text-center"><a @click="data.removeFromCart(item)" class="fw-bold">Xóa</a></td>
        </tr>
        <tr>
          <td colspan="2" class="text-end fw-bold text-uppercase">TỔNG TIỀN ĐƠN HÀNG (&#8363;):</td>
          <td colspan="2" class="text-center">
            <p>{{ data.totalCartItems }}</p>
          </td>
          <td scope="col" class="text-center">
            <a @click="data.removeAll()" class="border border-1 p-2 bg-danger text-white fw-bold"
              >Xóa tất cả</a
            >
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {}
</script>

<style scoped>
.page-header {
  background-color: #ebe8e2;
  font-size: 1rem;
}
.page-header a {
  font-size: 1rem;
}
.cart {
  background-color: #fff;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
  padding: 30px;
}
.null-cart {
  background-color: #fff;
  padding: 20px 0;
  text-align: center;
  /* align-content: center; */
}
.null-cart p {
  font-size: 18px;
}
</style>