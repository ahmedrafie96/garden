<template>
  <section
    v-if="posts.length > 0"
    class="discoverSecHolder container pt-xl-19 pb-xl-12 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 pt-10 pb-5"
  >
    <div class="row mb-xl-29 mb-lg-20 mb-12">
      <div class="col-12 col-lg-6 text-right pt-xl-14 pt-lg-5 mb-lg-0 mb-12">
        <span class="title position-relative d-block pr-7 mb-4">{{$t('discover')}}</span>
        <h2 class="fwEbold headingIV playfair mb-6">{{ posts[0].title }}</h2>
        <p class="mb-lg-10 mb-md-4" v-html="posts[0].content"></p>
        <router-link
          :to="{ name: `post`, params: { post } }"
          class="btn btnShop fwEbold text-green md-round py-3 px-4 py-md-3 px-md-4"
          >{{$t('view_now')}}<i :class="`fas fa-arrow-${$vuetify.rtl?'left':'right'} m${$vuetify.rtl?'r':'l'}-2 float-${$vuetify.rtl?'left':'right'}`"></i
        ></router-link>
      </div>
      <div class="col-12 col-lg-6">
        <div class="imgHolder position-relative">
          <img
            src="http://placehold.it/570x400"
            alt="image description"
            class="img-fluid w-100"
          />
          <img
            src="@/main/images/b-bdr.png"
            alt="image description"
            class="img-fluid bdr position-absolute"
          />
        </div>
      </div>
    </div>
    <div class="row rightAlign">
      <div class="col-12 col-lg-6 mb-lg-0 mb-4">
        <div class="imgHolder position-relative">
          <img
            src="http://placehold.it/570x400"
            alt="image description"
            class="img-fluid w-100"
          />
          <img
            src="@/main/images/b-bdr.png"
            alt="image description"
            class="img-fluid bdr position-absolute"
          />
        </div>
      </div>
      <div class="col-12 col-lg-6 pt-xl-14 pt-lg-5">
        <span class="title position-relative d-block pl-7 mb-4">{{$t('discover')}}</span>
        <h2 class="fwEbold headingIV playfair mb-6">{{ posts[1].title }}</h2>
        <p class="mb-lg-10 mb-md-4" v-html="posts[1].content"></p>

        <router-link
          :to="{ name: `post`, params: { post } }"
          class="btn btnShop fwEbold text-green md-round py-3 px-4 py-md-3 px-md-4"
          >{{$t('view_now')}} <i :class="`fas fa-arrow-${$vuetify.rtl?'left':'right'} m${$vuetify.rtl?'r':'l'}-2 float-${$vuetify.rtl?'left':'right'}`"></i
        ></router-link>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from "vuex";
export default {
  mounted() {
    this.$store.dispatch("post/index");
  },
  computed: {
    ...mapState({
      posts: (state) => state.post.all,
    }),
  },
};
</script>

<style>
</style>