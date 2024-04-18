<template>
  <div class="detail-image" v-if="product?.images">
    <Carousel
      id="gallery"
      :items-to-show="1"
      :wrap-around="false"
      v-model="currentSlide"
      :transition="600"
    >
      <Slide v-for="slide in product?.images.length" :key="slide">
        <div class="carousel__item" style="width: 500px; height: 350px; padding: 10px 0 10px 0">
          <img
            :src="product?.images[slide - 1]"
            alt=""
            width="100%"
            height="100%"
            style="object-fit: contain"
          />
        </div>
      </Slide>
      <template #addons>
        <Navigation />
      </template>
    </Carousel>

    <Carousel
      id="thumbnails"
      :items-to-show="6"
      :wrap-around="true"
      v-model="currentSlide"
      ref="carousel"
      :transition="600"
    >
      <Slide v-for="slide in product?.images.length" :key="slide">
        <div
          class="carousel__item"
          @click="slideTo(slide - 1)"
          style="
            border: 1px solid #000;
            margin: 5px;
            border-radius: 10px;
            width: 100px;
            height: 80px;
          "
        >
          <img
            :src="product?.images[slide - 1]"
            alt=""
            style="padding: 5px; object-fit: contain; border-radius: 10px"
            width="100%"
            height="100%"
          />
        </div>
      </Slide>
    </Carousel>
  </div>
  <div
    v-else
    class="detail-image d-flex justify-content-center align-items-center"
    style="height: 472px; width: 100%; border: 1px solid #d2d4d2; border-radius: 10px"
  >
    Mặt hàng này chưa có hình ảnh
    <font-awesome-icon icon="image" style="font-size: 20px" class="ms-2"></font-awesome-icon>
  </div>
</template>
  
  <script>
import { defineComponent } from 'vue'
import { Carousel, Slide, Navigation } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'

export default defineComponent({
  name: 'ProductDetail',
  components: {
    Carousel,
    Slide,
    Navigation
  },
  data: () => ({
    currentSlide: 0
  }),
  methods: {
    slideTo(val) {
      this.currentSlide = val
    }
  }
})
</script>
  
<script setup>
const { product } = defineProps({
  product: {
    required: false,
    type: Object
  }
})
</script>


<style scoped>
.carousel__slide {
  opacity: 0.4;
}
.carousel__slide--active ~ .carousel__slide {
}
.carousel__slide--active {
  opacity: 1;
}
.carousel__slide--clone {
  opacity: 0;
}
.carousel__prev,
.carousel__next {
  color: #008080 !important;
  border-radius: 50%;
  background-color: aqua !important;
}
</style>