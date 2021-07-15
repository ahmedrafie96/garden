<template>
  <div>
    <v-list width="300">
      <strong>
        {{ $t("also_read") }}
      </strong>
      <v-list-item
        v-for="post in posts"
        :key="post.id"
        link
        @click="changePost(post.id)"
      >
        <!-- <router-link :to="{ name: `post`, params: { id:post.id } }">
      </router-link> -->
        <!-- { name: 'post', params: { id: post.id } } -->
        <v-list-item-title>
          {{ post.title }}
        </v-list-item-title>
        <v-list-item-icon>
          <v-img :src="post.image.url" width="200" height="100"></v-img>
        </v-list-item-icon>
      </v-list-item>
    </v-list>
  </div>
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
  methods: {
    changePost(id) {
      this.$emit("changePost", id);
    },
  },
};
</script>

<style>
p {
  padding: 20px;
  line-height: 25px;
}
</style>