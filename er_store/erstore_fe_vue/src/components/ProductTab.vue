<template>
  <section class="product-tabs section-padding position-relative wow fadeIn animated">
    <!-- <div class="bg-square"></div> -->
    <div class="container">
      <div class="tab-header">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button
              class="nav-link active"
              id="nav-tab-one"
              data-bs-toggle="tab"
              data-bs-target="#tab-one"
              type="button"
              role="tab"
              aria-controls="tab-one"
              aria-selected="true"
            >
              Khuyến mãi sốc
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="nav-tab-two"
              data-bs-toggle="tab"
              data-bs-target="#tab-two"
              type="button"
              role="tab"
              aria-controls="tab-two"
              aria-selected="false"
            >
              Mua nhiều
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="nav-tab-three"
              data-bs-toggle="tab"
              data-bs-target="#tab-three"
              type="button"
              role="tab"
              aria-controls="tab-three"
              aria-selected="false"
            >
              Mới
            </button>
          </li>
        </ul>
        <a href="#" class="view-more d-none d-md-flex"
          >Xem tất cả<i class="fi-rs-angle-double-small-right"></i
        ></a>
      </div>
      <!--End nav-tabs-->
      <div class="tab-content wow fadeIn animated" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="tab-one"
          role="tabpanel"
          aria-labelledby="tab-one"
        >
          <div
            class="row product-grid-4 row-cols-2 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2"
          >
            <div class="" v-for="prod in prodList" v-bind:key="prod.id">
              <div class="product-cart-wrap mb-30">
                <div class="product-img-action-wrap">
                  <div class="product-img product-img-zoom">
                    <a href="product-details.html">
                      <img class="default-img" :src="prod.images[0]" alt="" />
                      <img class="hover-img" :src="prod.images[1]" alt="" />
                      <!-- <img class="default-img" src="../assets/imgs/shop/product-1-1.jpg" alt="" />
                      <img class="hover-img" src="../assets/imgs/shop/product-1-2.jpg" alt="" /> -->
                    </a>
                  </div>
                  <div class="product-action-1">
                    <a
                      aria-label="Chi tiết"
                      class="action-btn hover-up"
                      data-bs-toggle="modal"
                      data-bs-target="#quickViewModal"
                      ><i class="fi-rs-eye"></i
                    ></a>
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
                    <span class="hot">Hot SALE</span>
                  </div>
                </div>
                <div class="product-content-wrap">
                  <div class="product-category">
                    <a href="shop.html">TOSHIBA</a>
                  </div>
                  <h2>
                    <a href="product-details.html" class="product-title" title="Colorfull">{{
                      prod.prod_name
                    }}</a>
                  </h2>
                  <div class="rating-result" title="90%">
                    <span>
                      <span>90%</span>
                    </span>
                  </div>
                  <div class="product-price d-block">
                    <p>
                      <span class="old-price">{{ prod.prod_price }}</span>
                    </p>

                    <span>1.000.000 </span>
                  </div>
                  <div class="product-action-1 show">
                    <a aria-label="Thêm vào giỏ" class="action-btn hover-up" href="cart.html"
                      ><i class="fi-rs-shopping-bag-add"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="">
              <div class="product-cart-wrap">
                <div class="product-img-action-wrap">
                  <div class="product-img product-img-zoom">
                    <a href="product-details.html">
                      <img class="default-img" src="../assets/imgs/shop/product-8-1.jpg" alt="" />
                      <img class="hover-img" src="../assets/imgs/shop/product-8-2.jpg" alt="" />
                    </a>
                  </div>
                  <div class="product-action-1">
                    <a
                      aria-label="Quick view"
                      class="action-btn hover-up"
                      data-bs-toggle="modal"
                      data-bs-target="#quickViewModal"
                      ><i class="fi-rs-eye"></i
                    ></a>
                    <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"
                      ><i class="fi-rs-heart"></i
                    ></a>
                    <a aria-label="Compare" class="action-btn hover-up" href="compare.php"
                      ><i class="fi-rs-shuffle"></i
                    ></a>
                  </div>
                </div>
                <div class="product-content-wrap">
                  <div class="product-category">
                    <a href="shop.html">Shirt</a>
                  </div>
                  <h2>
                    <a href="product-details.html">Mens Porcelain Shirt</a>
                  </h2>
                  <div class="rating-result" title="90%">
                    <span>
                      <span>70%</span>
                    </span>
                  </div>
                  <div class="product-price">
                    <span>$238.85 </span>
                    <span class="old-price">$245.8</span>
                  </div>
                  <div class="product-action-1 show">
                    <a aria-label="Add To Cart" class="action-btn hover-up" href="cart.html"
                      ><i class="fi-rs-shopping-bag-add"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
          <!--End product-grid-4-->
        </div>
        <!--En tab one (Featured)-->
        <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
          <div
            class="row product-grid-4 row-cols-2 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2"
          >
            <div class="">
              <div class="product-cart-wrap mb-30">
                <div class="product-img-action-wrap">
                  <div class="product-img product-img-zoom">
                    <a href="product-details.html">
                      <img class="default-img" src="../assets/imgs/shop/product-3-1.jpg" alt="" />
                      <img class="hover-img" src="../assets/imgs/shop/product-3-2.jpg" alt="" />
                      <!-- <img class="default-img" src="../assets/imgs/shop/product-3-1.jpg" alt="" />
                      <img class="hover-img" src="../assets/imgs/shop/product-3-2.jpg" alt="" /> -->
                    </a>
                  </div>
                  <div class="product-action-1">
                    <a
                      aria-label="Chi tiết"
                      class="action-btn hover-up"
                      data-bs-toggle="modal"
                      data-bs-target="#quickViewModal"
                      ><i class="fi-rs-eye"></i
                    ></a>
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
                    <span class="best">Bán chạy</span>
                  </div>
                </div>
                <div class="product-content-wrap">
                  <div class="product-category">
                    <a href="shop.html">AQUA</a>
                  </div>
                  <h2>
                    <a href="product-details.html" class="product-title"
                      >Vintage Floral Oil Shirts</a
                    >
                  </h2>
                  <div class="rating-result" title="90%">
                    <span>
                      <span>95%</span>
                    </span>
                  </div>
                  <div class="product-price">
                    <p><span class="old-price">13.000.000</span></p>
                    <span>2.000.000 </span>
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
        <!--En tab two (Popular)-->
        <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
          <div
            class="row product-grid-4 row-cols-2 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2"
          >
            <div class="">
              <div class="product-cart-wrap mb-30">
                <div class="product-img-action-wrap">
                  <div class="product-img product-img-zoom">
                    <a href="product-details.html">
                      <img class="default-img" src="../assets/imgs/shop/product-2-1.jpg" alt="" />
                      <img class="hover-img" src="../assets/imgs/shop/product-2-2.jpg" alt="" />
                    </a>
                  </div>
                  <div class="product-action-1">
                    <a
                      aria-label="Chi tiết"
                      class="action-btn hover-up"
                      data-bs-toggle="modal"
                      data-bs-target="#quickViewModal"
                      ><i class="fi-rs-eye"></i
                    ></a>
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
                    <span class="new">Mới</span>
                  </div>
                </div>
                <div class="product-content-wrap">
                  <div class="product-category">
                    <a href="shop.html">FUNIKI</a>
                  </div>
                  <h2>
                    <a href="product-details.html" class="product-title"
                      >Plain Color Pocket Shirts</a
                    >
                  </h2>
                  <div class="rating-result" title="90%">
                    <span>
                      <span>50%</span>
                    </span>
                  </div>
                  <div class="product-price">
                    <p><span class="old-price">20.000.000</span></p>
                    <span>10.000.000</span>
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
        <!--En tab three (New added)-->
      </div>
      <!--End tab-content-->
    </div>
  </section>
</template>

<script setup>
import useProduct from '../services/productServices'
import { onMounted } from 'vue'
const { prodList, getAllProduct } = useProduct()
onMounted(getAllProduct)
// console.warn(brandList)
</script>

<style scoped>
.product-cart-wrap a.product-title {
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
</style>