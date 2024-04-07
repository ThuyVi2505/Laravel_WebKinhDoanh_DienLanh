<template>
  <section class="newsletter p-30 text-white wow fadeIn animated">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7 mb-md-3 mb-lg-0">
          <div class="row align-items-center">
            <div class="col flex-horizontal-center">
              <img class="icon-email" src="../assets/imgs/theme/icons/icon-email.svg" alt="" />
              <h4 class="font-size-20 mb-0 ml-3">ĐĂNG KÝ NHẬN THÔNG BÁO</h4>
            </div>
            <div class="col my-4 my-md-0 des">
              <h5 class="font-size-15 ml-4 mb-0">
                ...và nhận
                <strong>ưu đãi mua sắm hấp dẫn.</strong>
              </h5>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <!-- Subscribe Form -->
          <form class="form-subcriber d-flex wow fadeIn animated">
            <input
              type="email"
              class="form-control bg-white font-small"
              placeholder="Nhập email của bạn..."
            />
            <button class="btn bg-dark text-white" type="submit">ĐĂNG KÝ</button>
          </form>
          <!-- End Subscribe Form -->
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
section {
  background-color: #eef2f2;
}
</style>