<template>
  <div class="col-12 col-lg-6 order-lg-1">
    <!-- productSliderImage -->
    <div class="productSliderImage mb-lg-0 mb-4">
      <v-carousel
        v-model="model"
        :continuous="false"
        :cycle="true"
        :show-arrows="false"
        hide-delimiter-background
        delimiter-icon="mdi-minus"
        height="300"
      >
        <v-carousel-item v-for="image in media" :key="image.id">
          <v-sheet height="100%" tile>
            <v-row class="fill-height" align="center" justify="center">
              <v-img :src="image.url"></v-img>
            </v-row>
          </v-sheet>
        </v-carousel-item>
      </v-carousel>
      <!-- {{gallery.media}} -->
    </div>
  </div>
</template>

<script>
export default {
  props: ["gallery"],
  data() {
    return {
      model: {},
      media: [],
    };
  },

  mounted() {
    jQuery(".productSliderImage").slick({
      dots: false,
      speed: 800,
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      adaptiveHeight: true,
      autoplay: true,
      arrows: false,
      fade: true,
      autoplaySpeed: 2000,
      asNavFor: ".paggSlider",
    });
    if (this.$props.gallery) this.media = this.$props.gallery.media;
  },
  watch: {
    gallery: function (val) {
      if (val.media) {
        this.media = val.media;
      }
    },
  },
};
</script>

<style>
</style>