<template>
  <section class="introBlock position-relative">
    <div :key="slider.id" v-for="slider in settings.slider"></div>
    <div
      class="slick-fade"
      v-if="settings.slider"
      :dir="$vuetify.rtl ? 'rtl' : 'ltr'"
    >
      <!-- slider one -->
      <!-- slider one -->

      <div :key="slider.id" v-for="slider in settings.slider">
        <div
          class="align w-100 d-flex align-items-center bgCover"
          :style="
            $vuetify.rtl == true
              ? `background-image: url(/main/img/images/b-bg4.jpg)`
              : `background-image: url(/main/img/images/b-bg.jpg)`
          "
        >
          <!-- holder the text -->
          <div class="container position-relative holder pt-xl-10 pt-0">
            <!-- py-12 pt-lg-30 pb-lg-25 -->
            <div class="row">
              <div class="col-12 col-xl-7 textHolder" :style="`
                ${$vuetify.breakpoint.mobile ? 'padding: 30px;margin-top: 15%;':''}
              `">
                <div :class="`txtwrap p${$vuetify.rtl?'l':'r'}-lg-10`">
                  <span
                    :class="`
                      title
                      d-block
                      text-uppercase
                      fwEbold
                      position-relative
                      p${$vuetify.rtl?'r':'l'}-2
                      mb-lg-5 mb-sm-3 mb-1
                    `"
                  >
                    {{
                      slider.translation.find((t) => t.locale == locale).title
                    }}</span
                  >
                  <h2  class="fwEbold position-relative mb-xl-7 mb-lg-5 mt-5">
                    {{
                      slider.translation.find((t) => t.locale == locale).heading
                    }}
                  </h2>
                  <p class="mb-xl-15 mb-lg-10">
                    {{
                      slider.translation.find((t) => t.locale == locale)
                        .description
                    }}
                  </p>
                  <router-link
                    to="/store"
                    class="
                      btn
                      btnTheme
                      btnShop
                      fwEbold
                      text-white
                      md-round
                      py-2
                      px-3
                      py-md-3
                      px-md-4
                    "
                    >{{ $t("shop_now") }}<i :class="`fas fa-arrow-${$vuetify.rtl?'left':'right'} m${$vuetify.rtl?'r':'l'}-2 float-${$vuetify.rtl?'left':'right'}`"></i
                  ></router-link>
                </div>
              </div>
              <div
                class="imgHolder col-12 col-xl-7"
                :dir="$vuetify.rtl ? 'rtl' : 'ltr'"
              >
                <!-- 800*700 -->
                <img
                  :src="slider.image"
                  alt="image description"
                  class="img-fluid"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- slider one -->
    </div>

    <!-- slider -->
    <div
      dir="ltr"
      :class="`slickNavigatorsWrap  ${
        $vuetify.rtl ? 'slickNavigatorsWrapRTL' : ''
      }`"
    >
      <a href="#" class="slick-prev"><i class="icon-leftarrow"></i></a>
      <a href="#" class="slick-next"><i class="icon-rightarrow"></i></a>
    </div>
  </section>
</template>

<script>
import { mapState } from "vuex";

export default {
  name: "homeheader",
  props: ["settings"],
  watch: {
    settings: {
      handler: function (val) {
        if (val.slider) {
          setTimeout(() => {
            jQuery(".slick-fade").slick({
              slidesToScroll: 1,
              rows: 0,
              prevArrow: $(".slick-prev"),
              nextArrow: $(".slick-next"),
              dots: true,
              dotsClass: "slickNums",
              fade: true,
              adaptiveHeight: true,
              autoplay: true,
              infinite: true,
              rtl: this.$vuetify.rtl,
              responsive: [
                {
                  breakpoint: 576,
                  settings: {
                    dots: false,
                  },
                },
              ],
            });
          }, 1);
        }
      },
      deep: true,
    },
  },
  computed: {
    ...mapState({
      locale: (state) => state.locales.locale,
    }),
    imgStyle() {},
  },
};
</script>

<style>
.slick-fade[dir="rtl"] .title:before {
  right: 0px !important;
}
.slick-fade[dir="rtl"] .textHolder {
  text-align: right;
  float: right !important;
}
.slick-fade[dir="rtl"] .slickNums {
  direction: ltr;
  left: auto !important;
  right: auto !important;
  margin: auto;
  margin: 0 50px;
}
.slickNavigatorsWrapRTL {
  left: auto !important;
}
/* 
.slick-fade[dir="rtl"] .slickNums li {
  pointer-events: auto;
  text-indent: 0;
  position: relative;
}

.slick-fade[dir="rtl"] .slickNums li:first-child {
  margin-right: 58px !important;
  margin-left: auto !important;
}

.slick-fade[dir="rtl"] .slickNums li:last-child {
  display: block;
  padding-right: 22px;
  padding-left: 0 !important;
  text-indent: -99999px;
  
}

*/
/* .slick-fade[dir="rtl"] .slickNums button[id^="slick-slide-control"]:not(:nth-last-of-type()) {
  display:none !important;
}  */
.slick-fade[dir="rtl"] .slickNums li:not(:last-child) button[id^="slick-slide-control"]{
  display: none !important;
}
.introBannerHolder img{
  height: auto !important;
  position: absolute !important;

}
.introBannerHolder {
  position: relative;
  height: 400px;
}
#pageWrapper[dir="rtl"] .introBannerHolder img:first-child{
  right: -70px;
}
#pageWrapper[dir="rtl"] .introBannerHolder img:last-child{
  left: -70px;
}
#pageWrapper[dir="ltr"] .introBannerHolder img:last-child{
  right: -20px;
}
#pageWrapper[dir="ltr"] .introBannerHolder img:first-child{
  left: -20px;
}
@media (min-width: 768) {
  
}
</style>