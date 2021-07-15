<template>
  <main>

    <intro-section :slider="settings" />
    <!-- <about-section-holder :content="settings.content" /> -->

    <!-- <discover-section-holder :posts="discover_posts"/> -->
    <testimonial-section :clients="settings.clients" />
    <!-- <v-card flat>
      <v-card-title>
      <v-spacer></v-spacer>
        <span class="headline">{{$t('about')}}</span>
      <v-spacer></v-spacer>
      </v-card-title>
    </v-card > -->
    <about-us-section :key="index"  v-for="(paragraph , index) in settings.content.paragraphs " :paragraph="paragraph" />

    <feature-section :items="items" />
    <latest-section :posts="posts" />
    <partner-section :partners="settings.partners" />
      
    <!-- <subscribe-section /> -->
  </main>
</template>

<script>
import { mapState } from "vuex";
import About from './About.vue';
export default {
  components: { About },
  mounted() {
    this.$store.dispatch("setting/index");
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

<style>
</style>