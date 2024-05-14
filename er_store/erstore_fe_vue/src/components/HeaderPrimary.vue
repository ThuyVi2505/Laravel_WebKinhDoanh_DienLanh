<template>
  <header class="header-area header-style-1 header-height-2">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-3 col-lg-4">
            <div class="header-info">
              <ul>
                <li>
                  <a class="language-dropdown-active" href="#">
                    <font-awesome-icon icon="earth-americas" class="me-2" />Vietnamese
                    <i class="fi-rs-angle-small-down"></i
                  ></a>
                  <ul class="language-dropdown" style="min-width: 150px">
                    <li v-for="lang in Langs" v-bind:key="lang">
                      <a href="#"><img :src="lang.img" alt="" /> {{ lang.text }}</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-5 col-lg-4">
            <div class="text-center">
              <div
                id="news-flash"
                class="d-inline-block"
                style="overflow: hidden; position: relative; height: 14px"
              >
                <ul style="position: absolute; margin: 0px; padding: 0px; top: -13.8014px">
                  <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.0876175">
                    Supper Value Deals - Save more with coupons
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4">
            <div class="header-info header-info-right">
              <ul>
                <!-- <li>
                  <a class="language-dropdown-active" href="#">
                    Xin chào, Hoàng <i class="fi-rs-angle-small-down"></i
                  ></a>
                  <ul class="language-dropdown" style="min-width: 200px">
                    <li>
                      <a href="#"><i class="fi fi-rs-user"></i> Thông tin cá nhân</a>
                    </li>
                    <li>
                      <a href="#"><i class="fi-rs-shop"></i> Đơn hàng</a>
                    </li>
                    <li>
                      <a href="#"><i class="fi-rs-heart"></i> Mặt hàng yêu thích</a>
                    </li>
                    <hr class="my-1 text-primary fw-bold" />
                    <li>
                      <a href="#" class="text-danger"><i class="fi-rs-exit"></i> Đăng xuất</a>
                    </li>
                  </ul>
                </li> -->
                <li class="account">
                  <router-link :to="{ name: 'login' }" class="login">Đăng nhập</router-link>|
                  <router-link :to="{ name: 'register' }" class="register fw-bold text-primary"
                    >Tạo tài khoản</router-link
                  >
                  <!-- <a href="/login" class="login fw-semibold">Đăng nhập</a>| -->
                  <!-- <a href="/register" class="register fw-bold text-primary">Tạo tài khoản</a> -->
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block pb-2">
      <div class="container">
        <div class="header-wrap">
          <div class="logo logo-width-1">
            <router-link to="/"><img src="../assets/imgs/logo/logo.png" alt="logo" /></router-link>
            <!-- <a href=""><img src="../assets/imgs/logo/logo.png" alt="logo" /></a> -->
          </div>
          <div class="header-right">
            <div class="search-style-1">
              <form action="#">
                <input type="text" placeholder="Nhập từ khóa để tìm kiếm..." />
              </form>
            </div>
            <div class="header-action-right">
              <div class="header-action-2">
                <div class="header-action-icon-2">
                  <a href="shop-wishlist.php">
                    <img
                      class="svgInject"
                      alt="Surfside Media"
                      src="../assets/imgs/theme/icons/icon-heart.svg"
                    />
                    <span class="pro-count blue">4</span>
                  </a>
                </div>
                <div class="header-action-icon-2">
                  <a class="mini-cart-icon">
                    <img
                      class="svgInject"
                      alt="Surfside Media"
                      src="../assets/imgs/theme/icons/icon-cart.svg"
                    />
                    <span class="pro-count blue" v-if="data.countCartItems > 0">{{
                      data.countCartItems
                    }}</span>
                  </a>
                  <div class="cart-dropdown-wrap cart-dropdown-hm2">
                    <div v-if="data.getCartItems.length <= 0"><a>Giỏ hàng đang trống</a></div>
                    <div v-else>
                      <table class="table">
                        <tbody>
                          <tr>
                            <td colspan="3" class="text-end">
                              <a class="m" @click="data.removeAll()"
                                ><i class="fi-rs-cross-small"></i> Xóa tất cả</a
                              >
                            </td>
                          </tr>
                          <tr v-for="item in data.getCartItems" :key="item.id">
                            <td style="width: 60px">
                              <div class="shopping-cart-img">
                                <a href="product-details.html"
                                  ><img
                                    alt="Surfside Media"
                                    :src="item.images[0]"
                                    style="object-fit: contain"
                                    width="100%"
                                    height="100%"
                                /></a>
                              </div>
                            </td>
                            <td>
                              <div class="shopping-cart-title">
                                <h5>
                                  <a href="product-details.html">{{ item.prod_name }}</a>
                                </h5>
                                <h5 class="fw-normal">
                                  <span
                                    >{{ item.sale_price.toLocaleString('vi-VN') }} &#8363; × </span
                                  >{{ item.quantity }}
                                </h5>
                              </div>
                            </td>
                            <td>
                              <div class="shopping-cart-delete">
                                <a @click="data.removeFromCart(item)"
                                  ><i class="fi-rs-cross-small"></i
                                ></a>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="shopping-cart-footer">
                      <div class="shopping-cart-total">
                        <h4>
                          Tổng
                          <span>
                            {{ data.totalCartItems }}
                            &#8363;
                          </span>
                        </h4>
                      </div>
                      <div class="shopping-cart-button">
                        <router-link :to="{ name: 'ProductCart' }" class="outline">
                          Xem giỏ hàng
                        </router-link>
                        <a href="checkout.html" class="checkout bg-primary border-primary"
                          >Thanh toán</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
      <div class="container">
        <div class="header-wrap header-space-between position-relative">
          <div class="logo logo-width-1 d-block d-lg-none">
            <a><img src="../assets/imgs/logo/logo.png" alt="logo" /></a>
          </div>

          <div class="header-nav d-none d-lg-flex">
            <div class="main-categori-wrap d-none d-lg-block">
              <a class="categori-button-active" @click="toggleCategory">
                <span class="fi-rs-apps"></span> DANH MỤC SẢN PHẨM
              </a>
              <!-- category -->
              <div
                class="categori-dropdown-wrap categori-dropdown-active-large menu-show"
                :class="{ open: isOpen }"
              >
                <ul>
                  <template v-for="category in categoryList" :key="category.id">
                    <li
                      class="has-children"
                      v-if="category.parent_id === 0 && isHaveChild(category)"
                    >
                      <a href=""
                        ><i class="surfsidemedia-font-tshirt"></i>{{ category.cat_name }}</a
                      >
                      <div class="dropdown-menu">
                        <ul class="mega-menu d-lg-flex">
                          <li class="mega-menu-col col-lg-7">
                            <ul class="d-lg-flex">
                              <li class="mega-menu-col col-lg-6">
                                <ul>
                                  <li><span class="submenu-title">Thương hiệu</span></li>
                                  <li>
                                    <a class="dropdown-item nav-link nav_item" href="#">Toshiba</a>
                                  </li>
                                </ul>
                              </li>
                              <li class="mega-menu-col col-lg-6">
                                <ul>
                                  <li>
                                    <span class="submenu-title">Loại {{ category.cat_name }}</span>
                                  </li>
                                  <li
                                    v-for="childCategory in getChildCategory(category.id)"
                                    :key="childCategory.id"
                                  >
                                    <a class="dropdown-item nav-link nav_item" href="#">{{
                                      childCategory.cat_name
                                    }}</a>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                          <li class="mega-menu-col col-lg-5">
                            <div class="header-banner2">
                              <img
                                src="../assets/imgs/banner/menu-banner-4.png"
                                width="350px"
                                height="400px"
                                alt="menu_banner1"
                              />
                              <div class="banne_info">
                                <h6>10% Off</h6>
                                <h4>New Arrival</h4>
                                <a href="#">Shop now</a>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li v-if="category.parent_id === 0 && !isHaveChild(category)">
                      <a href=""
                        ><i class="surfsidemedia-font-desktop"></i>{{ category.cat_name }}</a
                      >
                    </li>
                  </template>

                  <!-- <li>
                    <ul class="more_slide_open" style="display: none">
                      <li>
                        <a href="shop.html"
                          ><i class="surfsidemedia-font-desktop"></i>Beauty, Health</a
                        >
                      </li>
                      <li>
                        <a href="shop.html"><i class="surfsidemedia-font-cpu"></i>Bags and Shoes</a>
                      </li>
                      <li>
                        <a href="shop.html"
                          ><i class="surfsidemedia-font-diamond"></i>Consumer Electronics</a
                        >
                      </li>
                      <li>
                        <a href="shop.html"
                          ><i class="surfsidemedia-font-home"></i>Automobiles &amp; Motorcycles</a
                        >
                      </li>
                    </ul>
                  </li> -->
                </ul>
                <!-- <div class="more_categories">Show more...</div> -->
              </div>
            </div>
            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
              <nav>
                <ul>
                  <menuBrand :brandList="brandList" />
                  <li>
                    <a>Về chúng tôi<i class="fi-rs-angle-down"></i></a>
                    <ul class="sub-menu menu-show">
                      <li><a href="#">Thông tin doanh nghiệp</a></li>
                      <li><a href="#">Chính sách bảo hành</a></li>
                      <li><a href="#">Bảo trì & lắp đặt</a></li>
                    </ul>
                  </li>
                  <!-- <li><a href="">Liên hệ</a></li> -->
                  <li><a href="">Khuyến mãi</a></li>
                  <li>
                    <a href="#">Tin tức<i class="fi-rs-angle-down"></i></a>
                    <ul class="sub-menu menu-show">
                      <li><a href="#">Khuyến mãi</a></li>
                      <li><a href="#">Thị trường điện lạnh</a></li>
                    </ul>
                  </li>
                  <!-- mega menu-test
                  <li class="position-static">
                    <a href="#">Our Collections <i class="fi-rs-angle-down"></i></a>
                    <ul class="mega-menu">
                      <li class="sub-mega-menu sub-mega-menu-width-22">
                        <a class="menu-title" href="#">Women's Fashion1</a>
                        <ul>
                          <li><a href="product-details.html">Dresses</a></li>
                          <li><a href="product-details.html">Blouses &amp; Shirts</a></li>
                          <li><a href="product-details.html">Hoodies &amp; Sweatshirts</a></li>
                          <li><a href="product-details.html">Wedding Dresses</a></li>
                          <li><a href="product-details.html">Prom Dresses</a></li>
                          <li><a href="product-details.html">Cosplay Costumes</a></li>
                        </ul>
                      </li>
                      <li class="sub-mega-menu sub-mega-menu-width-22">
                        <a class="menu-title" href="#">Men's Fashion</a>
                        <ul>
                          <li><a href="product-details.html">Jackets</a></li>
                          <li><a href="product-details.html">Casual Faux Leather</a></li>
                          <li><a href="product-details.html">Genuine Leather</a></li>
                          <li><a href="product-details.html">Casual Pants</a></li>
                          <li><a href="product-details.html">Sweatpants</a></li>
                          <li><a href="product-details.html">Harem Pants</a></li>
                        </ul>
                      </li>
                      <li class="sub-mega-menu sub-mega-menu-width-22">
                        <a class="menu-title" href="#">Technology</a>
                        <ul>
                          <li><a href="product-details.html">Gaming Laptops</a></li>
                          <li><a href="product-details.html">Ultraslim Laptops</a></li>
                          <li><a href="product-details.html">Tablets</a></li>
                          <li><a href="product-details.html">Laptop Accessories</a></li>
                          <li><a href="product-details.html">Tablet Accessories</a></li>
                        </ul>
                      </li>
                      <li class="sub-mega-menu sub-mega-menu-width-34">
                        <div class="menu-banner-wrap">
                          <a href="product-details.html"
                            ><img src="../assets/imgs/banner/menu-banner.jpg" alt="Surfside Media"
                          /></a>
                          <div class="menu-banner-content">
                            <h4>Hot deals</h4>
                            <h3>
                              Don't miss<br />
                              Trending
                            </h3>
                            <div class="menu-banner-price">
                              <span class="new-price text-success">Save to 50%</span>
                            </div>
                            <div class="menu-banner-btn">
                              <a href="product-details.html">Shop now</a>
                            </div>
                          </div>
                          <div class="menu-banner-discount">
                            <h3>
                              <span>35%</span>
                              off
                            </h3>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li> -->
                </ul>
              </nav>
            </div>
          </div>
          <div class="hotline d-none d-lg-block">
            <p>
              <font-awesome-icon icon="volume-control-phone" class="me-2" />
              <!-- <i class="fi-rs-smartphone"></i> -->
              <span>LIÊN HỆ HỖ TRỢ (24/24):</span>
              <a href="tel:10000000">(+1) 0000-000-000</a>
            </p>
          </div>
          <p class="mobile-promotion">
            Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%
          </p>
          <div class="header-action-right d-block d-lg-none">
            <div class="header-action-2">
              <div class="header-action-icon-2">
                <a href="shop-wishlist.php">
                  <img alt="Surfside Media" src="../assets/imgs/theme/icons/icon-heart.svg" />
                  <span class="pro-count white">4</span>
                </a>
              </div>
              <div class="header-action-icon-2">
                <a class="mini-cart-icon">
                  <img alt="Surfside Media" src="../assets/imgs/theme/icons/icon-cart.svg" />
                  <span class="pro-count white" v-if="data.countCartItems > 0">{{
                    data.countCartItems
                  }}</span>
                </a>
                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                  <div v-if="data.getCartItems.length <= 0"><a>Giỏ hàng đang trống</a></div>
                  <div v-else>
                    <table class="table">
                      <tbody>
                        <tr>
                          <td colspan="3" class="text-end">
                            <a class="m" @click="data.removeAll()"
                              ><i class="fi-rs-cross-small"></i> Xóa tất cả</a
                            >
                          </td>
                        </tr>
                        <tr v-for="item in data.getCartItems" :key="item.id">
                          <td style="width: 60px">
                            <div class="shopping-cart-img">
                              <a href="product-details.html"
                                ><img
                                  alt="Surfside Media"
                                  :src="item.images[0]"
                                  style="object-fit: contain"
                                  width="100%"
                                  height="100%"
                              /></a>
                            </div>
                          </td>
                          <td>
                            <div class="shopping-cart-title">
                              <h5>
                                <a href="product-details.html">{{ item.prod_name }}</a>
                              </h5>
                              <h5 class="fw-normal">
                                <span>{{ item.sale_price.toLocaleString('vi-VN') }} &#8363; × </span
                                >{{ item.quantity }}
                              </h5>
                            </div>
                          </td>
                          <td>
                            <div class="shopping-cart-delete">
                              <a @click="data.removeFromCart(item)"
                                ><i class="fi-rs-cross-small"></i
                              ></a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="shopping-cart-footer">
                    <div class="shopping-cart-total">
                      <h4>
                        Tổng
                        <span>
                          {{ data.totalCartItems }}
                          &#8363;
                        </span>
                      </h4>
                    </div>
                    <div class="shopping-cart-button">
                      <router-link :to="{ name: 'ProductCart' }" class="outline">
                        Xem giỏ hàng
                      </router-link>
                      <a href="checkout.html" class="checkout bg-primary border-primary"
                        >Thanh toán</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="header-action-icon-2 d-block d-lg-none">
                <div class="burger-icon burger-icon-white">
                  <span class="burger-icon-top"></span>
                  <span class="burger-icon-mid"></span>
                  <span class="burger-icon-bottom"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>
<script setup>
//services
import useBrand from '../services/brandServices'
import useCategory from '@/services/categoryServices'
import { onMounted } from 'vue'
import { useShopCartStore } from '../stores'
//get store
const data = useShopCartStore()
const { brandList, getAllBrand } = useBrand()
const { categoryList, getAllCategory, isHaveChild, getChildCategory } = useCategory()
onMounted(getAllBrand)
onMounted(getAllCategory)
</script>
<script>
// components
import menuBrand from '../components/brand/menuBrand.vue'
export default {
  name: 'HeaderPrimary',
  components: {
    menuBrand
  },
  created() {
    // this.fetchBrands()
  },
  data() {
    return {
      brands: [],
      isOpen: false,
      Langs: [
        {
          img: 'src/assets/imgs/theme/flag-fr.png',
          text: 'English'
        },
        {
          img: 'src/assets/imgs/theme/flag-dt.png',
          text: 'Vietnamese'
        }
      ]
    }
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll)
  },
  beforeUnmount() {
    window.removeEventListener('scroll', this.handleScroll)
  },
  methods: {
    toggleCategory() {
      this.isOpen = !this.isOpen
    },
    handleScroll() {
      let header = document.querySelector('.sticky-bar')
      let scroll = window.scrollY

      if (scroll < 200) {
        header.classList.remove('stick')
        let dropdowns = document.querySelectorAll('.header-style-2 .categori-dropdown-active-large')
        let buttons = document.querySelectorAll('.header-style-2 .categori-button-active')
        dropdowns.forEach((dropdown) => dropdown.classList.remove('open'))
        buttons.forEach((button) => button.classList.remove('open'))
      } else {
        header.classList.add('stick')
      }
    }
  }
}
</script>
<style scoped>
.open {
  display: block;
}
li.account a:hover,
li.account a.register:hover {
  color: orange !important;
}
.header-middle {
  background-color: #41aeae;
}
.svgInject {
  filter: invert(2);
}
a.checkout:hover {
  box-shadow: 2px 5px #e3e5e5;
}
.search-style-1 input::placeholder {
  color: #41aeae;
}
.search-style-1 input {
  color: #008080;
}
.menu-show {
  background-color: #ffffef !important;
  box-shadow: 1px 1px 5px #e3e5e5;
}
.position-static ul.mega-menu li a img:hover {
  background: white;
  box-shadow: 2px 3px 10px #e3e5e5;
}
</style>
