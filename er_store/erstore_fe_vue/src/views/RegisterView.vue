<template>
  <div class="page-header breadcrumb-wrap">
    <div class="container">
      <div class="breadcrumb">
        <router-link :to="{ name: 'home' }" rel="nofollow">Trang chủ</router-link>
        <!-- <a href="index.html" rel="nofollow">Home</a> -->
        <span></span> Tạo tài khoản
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
                <h3 class="mb-30 title">TẠO TÀI KHOẢN</h3>
              </div>
              <form method="post">
                <div class="form-group">
                  <input type="text" required="" name="name" placeholder="Nhập họ và tên" />
                </div>
                <div class="form-group">
                  <input type="text" required="" name="email" placeholder="Nhập email" />
                </div>
                <div class="form-group">
                  <input required="" type="password" name="password" placeholder="Nhập mật khẩu" />
                </div>
                <div class="form-group">
                  <input
                    required=""
                    type="confirmed-password"
                    name="password"
                    placeholder="Nhập lại mật khẩu"
                  />
                </div>
                <div class="login_footer form-group">
                  <div class="chek-form">
                    <div class="custome-checkbox">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        name="checkbox"
                        id="exampleCheckbox12"
                        value=""
                      />
                      <label class="form-check-label" for="exampleCheckbox12"
                        ><span
                          >Tôi đồng ý với
                          <a href="privacy-policy.html" rel="nofollow"
                            >điều khoản &amp; Chính sách.</a
                          ></span
                        ></label
                      >
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button
                    type="submit"
                    class="btn btn-fill-out btn-block hover-up w-100 fw-bold"
                    name="login"
                  >
                    ĐĂNG KÝ
                  </button>
                </div>
              </form>
              <div class="register pt-30 text-center">
                <h5 class="fw-normal">
                  Đã có tài khoản?
                  <router-link :to="{ name: 'login' }" class="fw-bold"> ĐĂNG NHẬP</router-link>
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
  border: 3px solid #d2d4d5;
}
input::placeholder {
  opacity: 0.6;
}
.invalid-feedback {
  font-size: 1em;
}
.title {
  font-weight: bold;
  color: #39b4ac;
}
.form-check-label a {
  font-weight: 600;
  color: #3984e3 !important;
}
.form-check-label a:hover {
  color: #f15412 !important;
}
.register h5 {
  color: #a4a1a1;
}
.register a {
  color: #3984e3 !important;
}
.register a:hover {
  color: #f15412 !important;
}
</style>