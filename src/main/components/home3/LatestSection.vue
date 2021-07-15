<template>
  <section
    class="
      latestSec
      container
      overflow-hidden
      pt-xl-12
      pb-xl-17
      pt-lg-10
      pb-lg-4
      pt-md-8
      pb-md-4
      pt-5
    "
    v-if="posts.length > 0"
  >
    <div class="row">
      <!-- mainHeader -->
      <header class="col-12 mainHeader mb-4 text-center">
        <h1 class="headingIV playfair fwEblod mb-6">
          {{ $t("from_our_blog") }}
        </h1>
        <span class="headerBorder d-block mb-5"
          ><img
            src="@/main/images/hbdr.png"
            alt="Header Border"
            class="img-fluid img-bdr"
        /></span>
        <p>{{ $t("see_latest_posts") }}</p>
      </header>
    </div>
    <v-row>
      <v-col cols="12" md="4" v-for="post in posts" :key="post.id">
        <!-- newsPostColumn -->
        <v-card
          style="padding: 0"
          :to="{ name: `post`, params: { id: post.id } }"
        >
          <v-img :src="post.image.url" height="350"></v-img>
          <v-card-text> </v-card-text>
          <v-card-title>
            <v-row justify="center">
              {{ post.title }}
            </v-row>
          </v-card-title>
          <v-card-actions>
            <span style="font-size: 0.8rem">
              <v-icon> mdi-account </v-icon>
              {{ post.writer.first_name }}
            </span>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </section>
</template>

<script>
export default {
  props: {
    posts: {
      default: () => {
        return [];
      },
    },
  },
};
</script>

<style>
</style>