<template>
  <v-card elevation="1" class="ma-5" v-if="post != {}">
    <v-card-text>
      <div class="imgHolder position-relative mb-6"></div>
      <router-link :to="{ name: `post`, params: { id: post.id } }">
        <v-img
          :src="post.image ? post.image.url : ''"
          alt="image description"
          max-height="350px"
        ></v-img>
      </router-link>


      <!-- <v-img
      :src="post.image.url"
      alt="image description"
      max-height="350px"
    ></v-img> -->

      <v-row style="margin-top: 20px">
        <v-col :style="`text-align:${$vuetify.rtl?'left':'right'};`">
          <!-- <strong
            style="
              color: #9d9d9d;
              font-size: 12px;
              font-weight: 700;
              padding: 5px;
            "
            >BY : {{ post.writer.first_name }}</strong
          > -->
          <!-- <v-icon small style="color: #9d9d9d"> mdi-account </v-icon> -->
          <strong style="margin-right: 20px; color: #9d9d9d; font-size: 12px">
            {{ new Date(post.created_at).toLocaleDateString() }}</strong
          >
          <v-icon small style="color: #9d9d9d; padding: 5px">
            mdi-clock
          </v-icon>
        </v-col>
      </v-row>
      <v-card-title>
        <v-row justify="center">
          <h1 style="word-break: break-word;">
            {{ post.title }}
          </h1>
        </v-row>
      </v-card-title>
      <v-row>
        <p solo v-html="post.content"></p>
      </v-row>
      <v-row class="ma-10" justify="end">
        <v-speed-dial
          v-model="fab"
          :bottom="bottom"
          :right="$vuetify.rtl"
          :left="!$vuetify.rtl"
          :direction="$vuetify.rtl ? 'right' : 'left'"
          transition="slide-y-reverse-transition"
        >
          <template v-slot:activator>
            <v-btn v-model="fab" color="blue darken-2" dark fab>
              <v-icon v-if="fab"> mdi-close </v-icon>
              <v-icon v-else> mdi-share-variant </v-icon>
            </v-btn>
          </template>
          <v-btn fab dark small color="green">
            <v-icon>fab fa-facebook</v-icon>
          </v-btn>
          <v-btn fab dark small color="indigo">
            <v-icon>fab fa-twitter</v-icon>
          </v-btn>
          <v-btn fab dark small color="red">
            <v-icon>fas fa-envelope</v-icon>
          </v-btn>
        </v-speed-dial>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import { mapState } from "vuex";
export default {
  mounted() {
    // console.log(this.$route);
    if (this.$route.params.id)
      this.$store.dispatch("post/show", { id: this.$route.params.id });
    else this.$router.push("/");
    this.$store.dispatch("post/index");
    window.scrollTo(0,0);
  },
  computed: {
    ...mapState({
      post: (state) => state.post.one,
    }),
  },
};
</script>

<style>
</style>