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
              <form @submit.prevent="register">
                <div class="form-group pb-10">
                  <label for="name" class="fw-bold">Họ và tên:</label>
                  <input
                    type="text"
                    name="name"
                    id="name"
                    v-model="name"
                    placeholder="Nhập họ và tên..."
                  />
                </div>
                <div class="form-group pb-10">
                  <label for="email" class="fw-bold">Email:</label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    v-model="email"
                    placeholder="Nhập email đăng ký..."
                    required
                  />
                </div>
                <div class="form-group pb-10">
                  <label for="password" class="fw-bold">Mật khẩu:</label>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    v-model="password"
                    placeholder="Nhập mật khẩu..."
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="confirmed-password" class="fw-bold">Xác nhận mật khẩu:</label>
                  <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    v-model="password_confirmation"
                    placeholder="Nhập lại mật khẩu..."
                    required
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
                      <label class="form-check-label register" for="exampleCheckbox12"
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

<script>
export default {
  methods: {
    register() {
      console.log('Register func...')
    }
  }
}
</script>

<style scoped>
.login_wrap {
  border: none;
  margin: 0 20px;
}
label {
  font-size: 15 !important;
  color: #f15412 !important;
  opacity: 0.8;
}
input {
  font-size: 16px;
  height: 45px;
  font-weight: 500;
  border-width: 2px;
}
input::placeholder {
  opacity: 0.8;
}
.title {
  font-weight: bold;
  color: #39b4ac;
}
.register a {
  color: #3984e3 !important;
}
.register a:hover {
  color: #f15412 !important;
}

.form-check-label {
  color: #000 !important;
}
</style>