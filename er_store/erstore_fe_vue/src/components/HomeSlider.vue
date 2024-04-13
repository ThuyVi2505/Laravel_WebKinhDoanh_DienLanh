<template>
  <swiper
    :options="swiperOptions"
    class="swiper1"
    :modules="modules"
    :centeredSlides="true"
    :centeredSlidesBounds="true"
    :slides-per-view="1"
    :navigation="true"
    :pagination="{ clickable: true }"
    :loop="true"
    :speed="2000"
    :grabCursor="true"
    :effect="'creative'"
    :creativeEffect="{
      prev: {
        translate: ['100%', 0, 0]
      },
      next: {
        shadow: true,
        translate: [0, 0, -200]
      }
    }"
    :autoplay="{
      delay: 4000,
      disableOnInteration: false
    }"
    @swiper="onSwiper"
    @slideChange="onSlideChange"
  >
    <swiper-slide class="slide"><img src="../assets/imgs/banner/1.png" alt="" /></swiper-slide>
    <swiper-slide class="slide"><img src="../assets/imgs/banner/2.png" alt="" /></swiper-slide>
    <swiper-slide class="slide"><img src="../assets/imgs/banner/3.png" alt="" /></swiper-slide>
  </swiper>
</template>
  <script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue'
// import Swiper core and required modules
import { Navigation, Pagination, Autoplay, EffectCreative } from 'swiper/modules'
import { defineComponent } from 'vue'
// Import Swiper styles
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'swiper/css/effect-creative'

export default defineComponent({
  components: {
    Swiper,
    SwiperSlide
  },

  setup() {
    const onSwiper = (swiper) => {
      console.log(swiper)
    }
    const onSlideChange = () => {
      console.log('slide change')
    }
    return {
      onSwiper,
      onSlideChange,
      modules: [Navigation, Pagination, Autoplay, EffectCreative]
    }
  }
})
</script>
<style scoped>
.swiper1 {
  background-color: #ffffff;
}
.swiper1 img {
  width: 100%;
  height: 100%;
  object-fit: fill;
}
.swiper-slide {
  height: auto !important;
}
.swiper-pagination-bullet-active {
  background-color: #ff8800 !important;
}
</style>