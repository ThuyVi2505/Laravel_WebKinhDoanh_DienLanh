<template>
  <swiper
    class="swiper1"
    :modules="modules"
    :centeredSlides="true"
    :centeredSlidesBounds="true"
    :slidesPerView="1"
    :navigation="{
      nextEl: '.swiper-button-next-fix',
      prevEl: '.swiper-button-prev-fix'
    }"
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
    <!-- Custom navigation buttons -->
    <div class="swiper-button-prev-fix">
      <font-awesome-icon icon="chevron-left" />
    </div>
    <div class="swiper-button-next-fix">
      <font-awesome-icon icon="chevron-right" />
    </div>
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
    // const onSwiper = (swiper) => {
    //   console.log(swiper)
    // }
    // const onSlideChange = () => {
    //   console.log('slide change')
    // }
    return {
      // onSwiper,
      // onSlideChange,
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
.swiper-button-prev-fix,
.swiper-button-next-fix {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: rgba(204, 208, 206, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  z-index: 10;
  color: #fff;
  transition: background-color 1s ease-out;
}

.swiper-button-prev-fix {
  left: 30px;
}

.swiper-button-next-fix {
  right: 30px;
}

.swiper-button-prev-fix:hover,
.swiper-button-next-fix:hover {
  background-color: rgba(0, 0, 0, 0.8);
}
.swiper-button-prev-fix svg,
.swiper-button-next-fix svg {
  width: 25px;
  height: 25px;
}
</style>