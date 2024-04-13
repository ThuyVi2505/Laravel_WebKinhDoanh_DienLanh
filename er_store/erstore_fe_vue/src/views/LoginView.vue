
<template>
  <div class="page-header breadcrumb-wrap">
    <div class="container">
      <div class="breadcrumb">
        <router-link :to="{ name: 'home' }" rel="nofollow">Trang chủ</router-link>
        <!-- <a href="index.html" rel="nofollow">Home</a> -->
        <span></span>
        <a style="pointer-events: none">Đăng nhập</a>
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
              <form @submit.prevent="submitLogin()">
                <div class="form-group">
                  <input
                    type="text"
                    name="email"
                    placeholder="Nhập email"
                    class="form-control"
                    @blur="validateForm()"
                    v-model="loginAttribute.email"
                    v-bind:class="{
                      'is-invalid': errors.email
                    }"
                  />
                  <span class="invalid-feedback" v-if="errors.email"
                    ><font-awesome-icon icon="circle-exclamation" class="me-2" />{{
                      errors.email
                    }}</span
                  >
                </div>
                <div class="form-group">
                  <input
                    type="password"
                    name="password"
                    placeholder="Nhập mật khẩu"
                    class="form-control"
                    @blur="validateForm()"
                    v-model="loginAttribute.password"
                    v-bind:class="{
                      'is-invalid': errors.password
                    }"
                  />
                  <span class="invalid-feedback" v-if="errors.password"
                    ><font-awesome-icon icon="circle-exclamation" class="me-2" />{{
                      errors.password
                    }}</span
                  >
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

<script>
export default {
  name: 'LoginView',
  data() {
    return {
      errors: {
        email: '',
        password: ''
      },
      loginAttribute: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    validateForm() {
      let isValid = true
      this.errors = {
        email: '',
        password: ''
      }
      if (!this.loginAttribute.email) {
        this.errors.email = 'Email bắt buộc nhập!'
        isValid = false
      }
      if (!this.loginAttribute.password) {
        this.errors.password = 'Mật khẩu bắt buộc nhập!'
        isValid = false
      }
      return isValid
    },
    submitLogin() {
      if (this.validateForm()) {
        alert('OK')
      }
    }
  }
}
</script>

<style scoped>
.page-header {
  background-color: #ebe8e2;
  font-weight: 600;
  font-size: 1rem;
}
.page-header a {
  font-size: 1rem;
}
.login_wrap {
  background-color: #fff;
  box-shadow: 1px 1px 2px #a4a1a1;
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
label {
  color: #3984e3 !important;
}
.invalid-feedback {
  font-size: 1em;
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