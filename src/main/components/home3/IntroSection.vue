<template>
  <section
    class="heroBlockHolder position-relative w-100 pt-xl-24 pb-xl-12 px-xl-17 pt-lg-16 pb-lg-12 pt-md-16 pb-md-0 pt-6"
    style="padding-top: 0 !important"
  >

    <!-- <div>{{ slider.slider }}</div> -->
    <v-carousel delimiter-icon="mdi-minus" cycle continuous v-model="model" hide-delimiters>
      <v-carousel-item
        v-for="(slide , index) in slider.slider"
        :key="index"
        :src="slide.image"
      >
        <v-row style="" class="fill-height">
          <v-col >
            <!-- <h2 style="" class="text ml-20" >
              {{slide.title}}

            </h2> -->
            <p v-html="slide.translation.value"></p>
          </v-col>
        </v-row>
      </v-carousel-item>
    </v-carousel>
  </section>
  
</template>


<script>
export default {
  props: ["slider"],
  // slider: {
  //   default: () => {
  //     return [];
  //   },

  // }
  data: () => ({
    model: 0,
    colors: ["primary", "secondary", "yellow darken-2", "red", "orange"],
    text: "<p>ahmad hassounad</p>",
  }),

  // colors: ["primary", "secondary", "yellow darken-2"],
};
</script>

<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=Tajawal&display=swap");
.text {
  font-family: Tajawal;
  line-height: 19px;
  text-shadow: 0.5px 1px;
  text-align: center;
  font-size: 20px;
  color: white;
  width: 80%;
}
</style>
