<template>
  <div class="info-sale-trans-top row">
    <div class="info-sale-trans-items col-6 col-lg-3">
      <div>
        <font-awesome-icon icon="book-bookmark" />
        <a href="">Cẩm nang mua sắm</a>
      </div>
    </div>
    <div class="info-sale-trans-items col-6 col-lg-3">
      <div>
        <font-awesome-icon icon="hand-holding-dollar" />
        <a href="">Tổng hợp khuyến mãi</a>
      </div>
    </div>
    <div class="info-sale-trans-items col-6 col-lg-3">
      <div>
        <font-awesome-icon icon="truck-fast" />
        <a href="">Vận chuyển, giao hàng</a>
      </div>
    </div>
    <div class="info-sale-trans-items col-6 col-lg-3">
      <div>
        <font-awesome-icon icon="screwdriver-wrench" />
        <a href="">Bảo trì, lắp đặt</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style>
.info-sale-trans-items {
  padding: 5px;
  box-shadow: 1px 0px 2px #d78080;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 60px;
}
.info-sale-trans-items svg {
  font-size: 25px;
  margin-right: 10px;
  color: #008080;
}
.info-sale-trans-items a {
  font-size: 18px;
  color: #6e6d6d;
}
.info-sale-trans-items:hover a {
  font-size: 18px;
  font-weight: bold;
  color: #ff4800;
}
</style>