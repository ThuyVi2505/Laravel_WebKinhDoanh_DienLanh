<template>
  <RegisterLetter />
  <footer class="main">
    <section class="section-padding footer-mid">
      <div class="container pt-15 pb-20">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="widget-about font-md mb-md-5 mb-lg-0">
              <div class="logo logo-width-1 wow fadeIn animated">
                <a href="index.html"><img src="../assets/imgs/logo/logo.png" alt="logo" /></a>
              </div>
              <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">LIÊN HỆ</h5>
              <p class="wow fadeIn animated"><strong>Địa chỉ: </strong>562 xxx xxx xxx</p>
              <p class="wow fadeIn animated"><strong>Số điện thoại: </strong>+1 0000-000-000</p>
              <p class="wow fadeIn animated"><strong>Email: </strong>contact@erstore.in</p>
              <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">
                Theo dõi chúng tôi tại:
              </h5>
              <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                <a href="#"><img src="../assets/imgs/theme/icons/icon-facebook.svg" alt="" /></a>
                <!-- <a href="#"><img src="../assets/imgs/theme/icons/icon-twitter.svg" alt="" /></a> -->
                <a href="#"><img src="../assets/imgs/theme/icons/icon-instagram.svg" alt="" /></a>
                <!-- <a href="#"><img src="../assets/imgs/theme/icons/icon-pinterest.svg" alt="" /></a> -->
                <a href="#"><img src="../assets/imgs/theme/icons/icon-youtube.svg" alt="" /></a>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-3">
            <h5 class="widget-title wow fadeIn animated">Thông tin</h5>
            <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
              <li><a href="#">Về chúng tôi</a></li>
              <li><a href="#">Mua sắm &amp; vận chuyển</a></li>
              <li><a href="#">Chính sách bảo mật</a></li>
              <li><a href="#">Điều khoản &amp; Điều kiện</a></li>
              <li><a href="#">Liên hệ với chúng tôi</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-3">
            <h5 class="widget-title wow fadeIn animated">Tin tức</h5>
            <ul class="footer-list wow fadeIn animated">
              <li><a href="#">Tin khuyến mãi</a></li>
              <li><a href="#">Tin thị trường</a></li>
            </ul>
          </div>
          <div class="col-lg-4 mob-center">
            <h5 class="widget-title wow fadeIn animated">Cài đặt APP</h5>
            <div class="row">
              <div class="col-md-8 col-lg-12">
                <p class="wow fadeIn animated">Từ App Store hoặc Google Play</p>
                <div class="download-app wow fadeIn animated mob-app">
                  <a href="#" class="hover-up mb-sm-4 mb-lg-0"
                    ><img class="active" src="../assets/imgs/theme/app-store.jpg" alt=""
                  /></a>
                  <a href="#" class="hover-up"
                    ><img src="../assets/imgs/theme/google-play.jpg" alt=""
                  /></a>
                </div>
              </div>
              <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                <p class="mb-20 wow fadeIn animated">Các cổng thanh toán</p>
                <img
                  class="wow fadeIn animated"
                  src="../assets/imgs/theme/payment-method.png"
                  alt=""
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="container pb-20 wow fadeIn animated mob-center">
      <div class="row">
        <div class="col-12 mb-20">
          <div class="footer-bottom"></div>
        </div>
        <div class="col-lg-6">
          <p class="float-md-left font-sm text-muted mb-0">
            <a href="privacy-policy.html">Privacy Policy</a> |
            <a href="terms-conditions.html">Terms & Conditions</a>
          </p>
        </div>
        <div class="col-lg-6">
          <p class="text-lg-end text-start font-sm text-muted mb-0">
            &copy; <strong class="text-brand">ER STORE</strong> All rights reserved
          </p>
        </div>
      </div>
    </div>
  </footer>
</template>


<script setup>
import RegisterLetter from './RegisterLetter.vue'
</script>
<style scoped>
section {
  border-top: 1px solid rgba(160, 152, 152, 0.5);
}
</style>