<script setup>
import { useShopCartStore } from '../../stores'
//get props
const { prod } = defineProps({
  prod: {
    required: true,
    type: Object
  }
})
//get store
const data = useShopCartStore()
</script>
<template>
  <div>
    <div class="product-cart-wrap mb-30">
      <div class="product-img-action-wrap">
        <div class="product-img product-img-zoom">
          <router-link
            :to="{
              name: 'ProductDetailView',
              params: { id: prod.id, slug: prod.prod_slug }
            }"
          >
            <img class="default-img" :src="prod.images[0]" alt="" />
            <img class="hover-img" :src="prod.images[1]" alt="" />
            <!-- <img class="default-img" src="../assets/imgs/shop/product-1-1.jpg" alt="" />
                      <img class="hover-img" src="../assets/imgs/shop/product-1-2.jpg" alt="" /> -->
          </router-link>
        </div>
        <div class="product-action-1">
          <!-- <a
                      aria-label="Chi tiết"
                      class="action-btn hover-up"
                      data-bs-toggle="modal"
                      data-bs-target="#quickViewModal"
                      ><i class="fi-rs-eye"></i
                    ></a> -->
          <a aria-label="Thêm vào yêu thích" class="action-btn hover-up" href="wishlist.php"
            ><i class="fi-rs-heart"></i
          ></a>
          <a aria-label="So sánh" class="action-btn hover-up" href="compare.php"
            ><i class="fi-rs-shuffle"></i
          ></a>
        </div>
        <div
          v-if="prod.sale_percent > 0"
          class="product-badges product-badges-position product-badges-mrg"
        >
          <span class="hot">- {{ prod.sale_percent }}%</span>
        </div>
      </div>
      <div class="product-content-wrap">
        <div class="product-category">
          <a href="">{{ prod.brand.name }}</a>
        </div>
        <h2>
          <router-link
            :to="{
              name: 'ProductDetailView',
              params: { id: prod.id, slug: prod.prod_slug }
            }"
            class="product-title"
            :title="prod.prod_name"
            >{{ prod.prod_name }}</router-link
          >
        </h2>
        <div class="product-star">
          <font-awesome-icon icon="star" class="checked" />
          <font-awesome-icon icon="star" class="checked" />
          <font-awesome-icon icon="star" class="checked" />
          <font-awesome-icon icon="star" class="checked" />
          <font-awesome-icon icon="star" />
        </div>
        <div class="d-flex justify-content-between">
          Xuất xứ: <span>{{ prod.origin_country }}</span>
        </div>
        <div class="d-flex justify-content-between">
          Bảo hành: <span>{{ prod.guarantee_period }} tháng</span>
        </div>
        <hr class="my-0" />
        <div class="product-price d-block">
          <p v-if="prod.sale_percent > 0">
            <span class="old-price">{{ prod.prod_price?.toLocaleString('vi-VN') }} &#8363;</span>
          </p>
          <p v-else><span class="old-price"></span></p>

          <span>{{ prod.sale_price?.toLocaleString('vi-VN') }} &#8363;</span>
        </div>
        <div class="product-action-1 show">
          <a aria-label="Thêm vào giỏ" class="action-btn hover-up" @click="data.addToCart(prod)"
            ><i class="fi-rs-shopping-bag-add"></i
          ></a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {}
</script>
<!-- <script setup>
const { prod } = defineProps({
  prod: {
    required: true,
    type: Object
  }
})
</script> -->
<style scoped>
.default-img,
.hover-img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}
.product-cart-wrap a.product-title {
  color: #008080;
  text-transform: uppercase;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  overflow: hidden;
  -webkit-line-clamp: 2; /* Số hàng tối đa */
  text-overflow: ellipsis; /* Hiển thị dấu chấm ba */
  white-space: normal; /* Cho phép xuống dòng */
}
/* Thêm khoảng trắng dưới nếu cần */
.product-cart-wrap a.product-title::after {
  content: '';
  display: inline-block;
  width: 100%;
  height: 1.2em; /* Chiều cao của dòng */
  background: linear-gradient(
    to bottom,
    rgba(255, 255, 255, 0),
    white
  ); /* Gradient để tạo khoảng trắng */
}
.product-star {
  margin-top: 0.5em;
}
.product-star svg {
  color: rgb(217, 218, 220);
}
.product-star .checked {
  color: rgb(255, 191, 0);
}
</style>