<template>
  <div class="page-header breadcrumb-wrap">
    <div class="container">
      <div class="breadcrumb">
        <router-link :to="{ name: 'home' }" rel="nofollow">Trang chủ</router-link>
        <!-- <a href="index.html" rel="nofollow">Home</a> -->
        <span></span> Đăng nhập
      </div>
    </div>
  </div>
  <section class="pt-50 pb-150">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-8 m-auto">
          <div
            class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5"
          >
            <div class="padding_eight_all bg-white">
              <div class="heading_s1">
                <h3 class="mb-30 title">ĐĂNG NHẬP TÀI KHOẢN</h3>
              </div>
              <form method="post">
                <div class="form-group">
                  <input type="text" required="" name="email" placeholder="Nhập email..." />
                </div>
                <div class="form-group">
                  <input required="" type="password" name="password" placeholder="Nhập mật khẩu" />
                </div>
                <div class="login_footer form-group">
                  <div class="chek-form">
                    <div class="custome-checkbox">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        name="checkbox"
                        id="exampleCheckbox1"
                        value=""
                      />
                      <label class="form-check-label" for="exampleCheckbox1"
                        ><span>Ghi nhớ</span></label
                      >
                    </div>
                  </div>
                  <a class="text-muted remember" href="#">Quên mật khẩu?</a>
                </div>
                <div class="form-group">
                  <button
                    type="submit"
                    class="btn btn-fill-out btn-block hover-up w-100 fw-bold"
                    name="login"
                  >
                    ĐĂNG NHẬP
                  </button>
                </div>
              </form>
              <div class="register pt-30 text-center">
                <h5 class="fw-normal">
                  Chưa có tài khoản?
                  <router-link :to="{ name: 'register' }" class="fw-bold">
                    ĐĂNG KÝ NGAY</router-link
                  >
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup></script>

<style scoped>
.login_wrap {
  border: none;
  margin: 0 20px;
}
input {
  font-size: 16px;
  height: 50px;
}
.title {
  font-weight: bold;
  color: #39b4ac;
}
.remember {
  font-size: 16px;
  color: #3984e3 !important;
}
.remember:hover {
  color: #f15412 !important;
}
.register a:hover {
  color: #3984e3 !important;
}
</style>