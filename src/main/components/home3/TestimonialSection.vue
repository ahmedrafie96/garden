<template>
  <div class="container-fluid px-xl-20 px-lg-17" v-if="clients.length > 0">
    <!-- testimonailBlock -->
    <section class="testimonailBlock pt-xl-8 pb-xl-11 py-lg-10 py-md-8 py-5">
      <header class="col-12 mainHeader mb-sm-9 mb-5 text-center">
        <h1 class="headingIV playfair fwEblod">What Say Client</h1>
      </header>
      <div class="container">
        <!-- testimonailSlider -->
        <div class="testimonailSlider slick2 overflow-hidden">
          <v-carousel
            v-model="model"
            hide-delimiter-background
            cycle
            hide-delimiters
            vertical-delimiters
            continuous
          >
            <v-carousel-item v-for="client in clients">
              <div>
                <div class="slide text-center">
                  <span class="icon-qoute mb-2 d-block"></span>
                  <p class="mb-7" style="color: #222">
                    {{ client.text }}
                  </p>
                  <strong
                    class="title d-block fwEbold mb-1"
                    style="justify-content: center"
                  >
                    <v-img
                      :src="client.image"
                      width="100"
                      style="margin: 5px auto"
                    ></v-img>
                    {{ client.name }}
                  </strong>
                  <span class="desination">{{ client.title }}</span>
                </div>
              </div>
            </v-carousel-item>
          </v-carousel>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  props: {
    clients: {
      default: () => {
        return [];
      },
    },
  },
  data() {
    return {
      model: 0,
    };
  },
  mounted() {
    jQuery(".testimonailSlider").slick({
      dots: true,
      speed: 800,
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      adaptiveHeight: true,
      autoplay: true,
      arrows: false,
      fade: true,
      autoplaySpeed: 2000,
    });
  },
};
</script>

<style>
</style>