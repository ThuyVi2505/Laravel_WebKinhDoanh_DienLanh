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
              <form @submit.prevent="login" method="post">
                <div class="form-group pb-10">
                  <label for="email" class="fw-bold">Tài khoản Email:</label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    v-model="email"
                    placeholder="Nhập email..."
                    required
                  />
                </div>
                <div class="form-group">
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
                      <label class="form-check-label check-box" for="exampleCheckbox1"
                        ><span>Ghi nhớ</span></label
                      >
                    </div>
                  </div>
                  <a class="text-muted remember" href="#">Quên mật khẩu?</a>
                </div>
                <div class="form-group">
                  <button class="btn btn-fill-out btn-block hover-up w-100 fw-bold" name="login">
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

<script>
export default {
  data() {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    login() {
      this.$store.dispatch('AUTH/login', { email: this.email, password: this.password })
      // if (this.$store.state.token) {
      //   this.$router.push('/home')
      // } else {
      //   // Redirect to dashboard or other route upon successful login
      //   this.$router.push('/register')
      // }
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
.check-box {
  color: #3984e3 !important;
}
.remember {
  font-size: 16px;
  color: #3984e3 !important;
}
.remember:hover {
  color: #f15412 !important;
}
.register a {
  color: #3984e3 !important;
}
.register a:hover {
  color: #f15412 !important;
}
</style>