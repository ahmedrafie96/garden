<template>
  <div id="pageWrapper">
    <!-- pageHeader -->
      <!-- <ha-site-header /> -->
    <!-- main -->
    <main>
      <!-- introBlock -->
      <ha-intro-block :settings="settings"/>
      <!-- chooseUs-sec -->
      <ha-choose-us :settings="settings.WhyChooseUs" />
         
      <!-- featureSec -->
      <ha-feature-section :items="items" />  

      <!-- contactListBlock -->
      <ha-contact />
      <!-- productOfferSec -->
        <ha-product-offer :advertisings="settings.advertisings" />
      <!-- dealSecHolder -->
      <ha-deals-holder :items="items" />
      <!-- partnerSec -->
      <ha-partner-section :partners="settings.partners"/>
      <ha-subscribe-holder  />
      <!-- footerHolder -->
      <!-- <ha-footer-holder /> -->
    </main>
    <!-- footer -->
    <ha-footer/>
  </div>
</template>

<script>
import { mapState } from "vuex";
import About from './About.vue';
export default {
  components: { About },
  mounted() {
    this.$store.dispatch("setting/index");
    this.$store.dispatch("item/index");
    window.scrollTo(0,0);
  },
  data() {
    return {
      posts: [],
      items: [],
      discover_posts: [],
    };
  },
  computed: {
    ...mapState({
      settings: (state) => state.setting.all,
     
    }),
  },
  watch: {
    settings: {
      async handler(val) {
        // this.$store.dispatch("post/index",{
        //   ids:this.settings.featured_posts
        // }).then((res)=>{
        //   console.log(res);
        //   this.posts = res;
        // });
        this.posts = await this.$store.dispatch("post/index", {
          ids: this.settings.featured_posts,
        });
        this.items = await this.$store.dispatch("item/index", {
          ids: this.settings.featured_items,
        });
      },
    },
  },
};
</script>
