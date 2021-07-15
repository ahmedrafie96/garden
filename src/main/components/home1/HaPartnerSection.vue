<template>
  <div
    dir="ltr"
    class="
      partnerSec
      container
      overflow-hidden
      pt-xl-12
      pb-xl-23
      pt-lg-10 pt-md-8 pt-5
      pb-lg-20 pb-md-16 pb-10
    "
  >
    <div class="row">
      <div class="col-12">
        <!-- partnerSlider -->
        <div class="partnerSlider d-flex flex-wrap">
          <div v-for="partner in partners">
            <div
              class="
                logoColumn
                d-flex
                align-items-center
                justify-content-center
              "
            >
              <a :href="`https://${partner.link}`"
                ><img
                  width="105"
                  style="width: 100%;height: 100%;"
                  
                  :src="partner.image"
                  alt="Partner Logo"
                  class="img-fluid"
              /></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["partners"],
  mounted() {},
  watch: {
    partners() {

    },
  },
  mounted(){
          setTimeout(() => {
        console.log("ACTIVATED");
        jQuery(".partnerSlider").slick({
          dots: false,
          speed: 800,
          infinite: true,
          slidesToShow: 6,
          slidesToScroll: 1,
          adaptiveHeight: true,
          autoplay: true,
          arrows: false,
          autoplaySpeed: 2000,
          responsive: [
            {
              breakpoint: 1170,
              settings: {
                slidesToShow: 4,
              },
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 4,
              },
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 2,
              },
            },
          ],
        });
      }, 1000);
  }
};
</script>

<style>
</style>