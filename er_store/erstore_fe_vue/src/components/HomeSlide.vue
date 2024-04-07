<template>
  <section class="home-slider position-relative pt-50">
    <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
      <div class="single-hero-slider single-animation-wrap">
        <div class="container">
          <div class="row align-items-center slider-animated-1">
            <div class="col-lg-5 col-md-6">
              <div class="hero-slider-content-2">
                <h4 class="animated">Trade-in offer</h4>
                <h2 class="animated fw-900">Supper value deals</h2>
                <h1 class="animated fw-900 text-brand">On all products</h1>
                <p class="animated">Save more with coupons & up to 70% off</p>
                <a class="animated btn btn-brush btn-brush-3" href="product-details.html">
                  Shop Now
                </a>
              </div>
            </div>
            <div class="col-lg-7 col-md-6">
              <div class="single-slider-img single-slider-img-1">
                <img class="animated slider-1-1" src="../assets/imgs/slider/slider-1.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="single-hero-slider single-animation-wrap">
        <div class="container">
          <div class="row align-items-center slider-animated-1">
            <div class="col-lg-5 col-md-6">
              <div class="hero-slider-content-2">
                <h4 class="animated">Hot promotions</h4>
                <h2 class="animated fw-900">Fashion Trending</h2>
                <h1 class="animated fw-900 text-7">Great Collection</h1>
                <p class="animated">Save more with coupons & up to 20% off</p>
                <a class="animated btn btn-brush btn-brush-2" href="product-details.html">
                  Discover Now
                </a>
              </div>
            </div>
            <div class="col-lg-7 col-md-6">
              <div class="single-slider-img single-slider-img-1">
                <img class="animated slider-1-2" src="../assets/imgs/slider/slider-2.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="slider-arrow hero-slider-1-arrow"></div>
  </section>
</template>

<script>
export default {
  mounted() {
    this.HomeSlick()
  },
  methods: {
    HomeSlick() {
      // Slick slider initialization
      document.querySelector('.hero-slider-1').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        loop: true,
        dots: true,
        arrows: true,
        prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-angle-left"></i></span>',
        nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-angle-right"></i></span>',
        appendArrows: '.hero-slider-1-arrow',
        autoplay: true
      })
    }
  }
}
</script>