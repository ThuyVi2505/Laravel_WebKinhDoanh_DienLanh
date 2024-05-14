<template>
  <div class="sub-info row">
    <div class="col-12 col-lg-5">
      <h4 class="text-uppercase my-2">Thông số kỹ thuật</h4>
      <div class="table-container">
        <table class="table table-md mt-3 attributes-table">
          <thead class="border">
            <tr>
              <th>Tên</th>
              <th>Đặc điểm</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Model</td>
              <td class="text-uppercase">{{ prodDetail?.prod_model }}</td>
            </tr>
            <tr>
              <td>Thương hiệu</td>
              <td class="text-uppercase">{{ prodDetail?.brand?.name }}</td>
            </tr>
            <tr>
              <td>Loại sản phẩm</td>
              <td class="">{{ prodDetail?.category?.name }}</td>
            </tr>
            <tr>
              <td>Xuất xứ</td>
              <td class="">{{ prodDetail?.origin_country }}</td>
            </tr>
            <tr>
              <td>Thời gian bảo hành</td>
              <td class="">{{ prodDetail?.guarantee_period }} tháng</td>
            </tr>
            <tr v-for="(value, key) in prodDetail?.attributes" :key="key">
              <td>{{ key }}</td>
              <td>{{ value }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-12 col-lg-7">
      <h4 class="text-uppercase my-2">Mô tả sản phẩm</h4>
      <p class="mt-3" style="font-size: 18px">{{ prodDetail?.prod_description }}</p>
    </div>
  </div>
</template>

<script>
</script>
<script setup>
const { prodDetail } = defineProps({
  prodDetail: {
    required: false,
    type: Object
  }
})
</script>

<style scoped>
tr {
  font-size: 18px;
}
.sub-info {
  padding: 5px 20px 5px 20px;
}
</style>