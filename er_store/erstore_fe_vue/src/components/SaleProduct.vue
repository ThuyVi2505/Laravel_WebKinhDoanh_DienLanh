<template>
  <div class="sale-product-items">
    <div class="sale-product-items-top">
      <div class="d-flex align-items-center">
        <img src="../assets/imgs/gif/star.gif" alt="" style="width: 48px; height: 48px" />
        <p>HOT SALE</p>
        <img src="../assets/imgs/gif/star.gif" alt="" style="width: 48px; height: 48px" />
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
            <div
              class=""
              v-for="prod in prodList
                .filter((product) => product.sale.percent !== 0)
                .sort((b, a) => a.id - b.id)
                .slice(0, 10)"
              v-bind:key="prod.id"
            >
              <div class="product-cart-wrap mb-30">
                <div class="product-img-action-wrap">
                  <div class="product-img product-img-zoom">
                    <router-link
                      :to="{ name: 'ProductDetail', params: { slug: prod.prod_slug, id: prod.id } }"
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
                    <a
                      aria-label="Thêm vào yêu thích"
                      class="action-btn hover-up"
                      href="wishlist.php"
                      ><i class="fi-rs-heart"></i
                    ></a>
                    <a aria-label="So sánh" class="action-btn hover-up" href="compare.php"
                      ><i class="fi-rs-shuffle"></i
                    ></a>
                  </div>
                  <div class="product-badges product-badges-position product-badges-mrg">
                    <span class="hot">giảm {{ prod.sale.percent }}%</span>
                  </div>
                </div>
                <div class="product-content-wrap">
                  <div class="product-category">
                    <a href="">{{ prod.brand.name }}</a>
                  </div>
                  <h2>
                    <router-link
                      :to="{ name: 'ProductDetail', params: { slug: prod.prod_slug, id: prod.id } }"
                      class="product-title"
                      :title="prod.prod_name"
                      >{{ prod.prod_name }}</router-link
                    >
                  </h2>
                  <!-- <div class="rating-result" title="90%">
                    <span>
                      <span>90%</span>
                    </span>
                  </div> -->
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
                    <p>
                      <span class="old-price"
                        >{{ prod.prod_price.toLocaleString('vi-VN') }} &#8363;</span
                      >
                    </p>

                    <span>{{ prod.sale.price.toLocaleString('vi-VN') }} &#8363;</span>
                  </div>
                  <div class="product-action-1 show">
                    <a aria-label="Thêm vào giỏ" class="action-btn hover-up" href="cart.html"
                      ><i class="fi-rs-shopping-bag-add"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--End product-grid-4-->
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import useProduct from '../services/productServices'
import { onMounted } from 'vue'
const { prodList, getAllProduct } = useProduct()
onMounted(getAllProduct)
</script>
<script>
import { defineComponent } from 'vue'

export default defineComponent({})
</script>

<style scoped>
/* .sale-product-items {
} */
.sale-product-items-top {
  height: 80px;
  background-image: url('../assets/imgs/banner/bg-banner1.png');
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.sale-product-items-top p {
  margin: 0 5px 0 5px;
  font-size: 30px;
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