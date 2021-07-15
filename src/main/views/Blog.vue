<template>
  <main>
    <!-- introBannerHolder -->
    <intro-banner-holder :title="$t('blog')" :sub_route="$t('blog')" />

    <!-- twoColumns -->
    <div
      dir="ltr"
      class="twoColumns container pt-lg-23 pb-lg-20 pt-md-16 pb-md-4 pt-10 pb-4"
    >
      <div class="row">
        <div class="col-12 col-lg-9 order-lg-3">
          <!-- content -->
          <article id="content">
            <!-- newsBlogColumn -->
            <div
              v-for="post in posts"
              :key="post.id"
              class="newsBlogColumn mb-md-9 mb-6"
            >
              <div class="imgHolder position-relative mb-6">
                <router-link :to="`post/${post.id}`">
                  <img
                    :src="post.image.url"
                    alt="image description"
                    class="img-fluid"
                    width="100%"
                  />
                </router-link>
              </div>
              <div
                style="width: 100%"
                class="textHolder align-items-start"
              >
                <time
                  class="time text-center text-uppercase py-sm-3 py-1 px-1"
                  :datetime="post.created_at"
				  :style="`float:${$vuetify.rtl?'right':'left'}`"
                >
                  <strong class="fwEbold d-block mb-1">{{
                    post.created_at.slice(8, 10)
                  }}</strong>
                  {{
                    new Date(post.created_at).toLocaleString("default", {
                      month: "long",
                    })
                  }}</time
                >
                <div class="alignLeft pl-sm-6 pl-3" 
				  :style="`float:${$vuetify.rtl?'right':'left'};width: 90%;padding:5px;`"
				>
                  <h2 class="headingV fwEbold mb-2">
                    <router-link :to="`post/${post.id}`">{{
                      post.title ? post.title : "Post Title"
                    }}</router-link>
                  </h2>
                  <p class="mb-0" v-html="post.summary"></p>
                </div>
              </div>
			  <div class="clear-fix"></div>
            </div>
            <!-- newsBlogColumn -->
          </article>
          <div style="margin-top: 202px" dir="ltr" class="col-12 mb-sm-0 mb-6">
            <!-- pagination -->
            <pagination
              :meta="meta"
              @paginated="(v) => $store.dispatch('post/changeCurrentPage', v)"
              class="col-12 pt-3 mb-lg-0 mb-md-6 mb-3"
            />
          </div>
        </div>
        <div class="col-12 col-lg-3 order-lg-1">
          <!-- sidebar -->
          <aside id="sidebar">
            <!-- widget -->
            <section class="widget overflow-hidden mb-md-9 mb-6">
              <h3 class="headingVII fwEbold text-uppercase mb-4">
                {{ $t("search") }}
              </h3>
              <form
                action="javascript:void(0);"
                class="searchForm position-relative border"
              >
                <fieldset>
                  <input
                    v-model="params.title"
                    type="search"
                    class="form-control"
                    placeholder="Search product..."
                  />
                  <button class="position-absolute">
                    <i class="icon-search"></i>
                  </button>
                </fieldset>
              </form>
            </section>
            <!-- widget -->
            <section class="widget overflow-hidden mb-md-9 mb-6">
              <h3 class="headingVII fwEbold text-uppercase mb-2">
                {{ $t("recent_posts") }}
              </h3>
              <ul class="list-unstyled recentPostList mb-0">
                <li v-for="post in posts" :key="post.id">
                  <a :href="`/post/${post.id}`" class="py-2 d-block">{{
                    post.title ? post.title : "Post Title"
                  }}</a>
                  <p>
                  </p>
                </li>
                <!-- <li><a href="javascript:void(0);" class="py-2 d-block">Post with Gallery</a></li>
									<li><a href="javascript:void(0);" class="py-2 d-block">Post with Audio</a></li>
									<li><a href="javascript:void(0);" class="py-2 d-block">Post with Video</a></li>
									<li><a href="javascript:void(0);" class="py-2 d-block">Maecenas ultricies</a></li> -->
              </ul>
            </section>
            <!-- widget -->
            <!-- <section class="widget overflow-hidden mb-md-9 mb-6">
								<h3 class="headingVII fwEbold text-uppercase mb-2">RECENT COMMENTS</h3>
								<ul class="list-unstyled recentPostList mb-0">
									<li><a href="javascript:void(0);" class="py-2 d-block">Admin on Vivamus blandit</a></li>
									<li><a href="javascript:void(0);" class="py-2 d-block">Admin on Vivamus blandit</a></li>
									<li><a href="javascript:void(0);" class="py-2 d-block">Admin on Vivamus blandit</a></li>
									<li><a href="javascript:void(0);" class="py-2 d-block">Admin on Vivamus blandit</a></li>
									<li><a href="javascript:void(0);" class="py-2 d-block">Admin on Vivamus blandit</a></li>
								</ul>
							</section> -->
            <!-- widget -->
            <!-- <section class="widget overflow-hidden mb-md-6 mb-3">
								<h3 class="headingVII fwEbold text-uppercase mb-4">ARCHIVES</h3>
								<ul class="list-unstyled archiveList mb-0">
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">March 2018</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">December 2018</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">November 2018</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">September 2018</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">August 2018</a></li>
								</ul>
							</section> -->
            <!-- widget -->
            <section class="widget overflow-hidden mb-md-5 mb-3">
              <h3 class="headingVII fwEbold text-uppercase mb-4">
                {{ $t("categories") }}
              </h3>
              <ul class="list-unstyled archiveList mb-0">
                <li v-for="post in posts" :key="post.id" class="mb-3">
                  <a href="javascript:void(0);" class="d-block">{{
                    post.category ? post.category.name : ""
                  }}</a>
                </li>
                <!-- <li class="mb-3"><a href="javascript:void(0);" class="d-block">Fashion</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">Image</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">Photography</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">Travel</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">Videos</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">WordPress</a></li> -->
              </ul>
            </section>
            <!-- widget -->
            <!-- <section class="widget overflow-hidden mb-md-9 mb-6">
								<h3 class="headingVII fwEbold text-uppercase mb-4">META</h3>
								<ul class="list-unstyled archiveList mb-0">
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">Log in</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">Entries RSS</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">Comments RSS</a></li>
									<li class="mb-3"><a href="javascript:void(0);" class="d-block">WordPress.org</a></li>
								</ul>
							</section> -->
          </aside>
        </div>
      </div>
    </div>
    <div class="container mb-lg-24 mb-md-16 mb-10">
      <!-- subscribeSecBlock -->
      <ha-subscribe-holder />
    </div>
    <!-- footerHolder -->
  </main>

  <!-- 
  <main>
    <v-container>
      <v-row>
        <v-col>
          <article
            style="margin-top: -50px"
            v-for="post in posts"
            id="content"
            :key="post.id"
          >
            <blog-article :post="post"> </blog-article>
          </article>
          <pagination
            :meta="meta"
            @paginated="(v) => $store.dispatch('post/changeCurrentPage', v)"
            class="col-12 pt-3 mb-lg-0 mb-md-6 mb-3"
          />
        </v-col>
        <v-col cols="12" class="hidden-sm-and-down">
          <h5 class="text-center">
            {{ $t("Recent Posts") }}
          </h5>
          <v-row>
            <v-col cols="12" md="3">
              <v-card
                :height="height"
                class="cardd"
                v-for="(post, index) in posts"
                :key="index"
                :to="{ name: `post`, params: { id: post.id } }"
              >
                <v-card-title>
                  <v-row justify="center" class="pb-2">
                    {{ post.title }}
                  </v-row>
                </v-card-title>
                <v-card-text>
                  <v-img :src="post.image.url"></v-img>
                </v-card-text>
                <v-card-actions>
                  <span style="font-size: 0.8rem">
                    <v-icon> mdi-account </v-icon>
                    {{ post.writer.first_name }}
                  </span>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </main> -->
</template>

<script>
import { mapState } from "vuex";
export default {
  mounted() {
    this.$store.dispatch("post/index");
    // window.FB.XFBML.parse();
    window.scrollTo(0,0);
  },
  data() {
    return {
      params: {},
      window: window,
      breakpoint: this.$vuetify.breakpoint.name,
    };
  },
  watch: {
    window() {},
    height(newval) {
      console.log(newval);
    },
  },
  computed: {
    ...mapState({
      posts: (state) => state.post.all,
      meta: (state) => state.post.meta,
    }),
  },
  watch: {
    params: {
      handler(val) {
        this.$store.dispatch("post/index", val);
      },
    },
  },
  // created(){

  //   this.$store.dispatch('FB_Parse')
  // }
};
</script>

<style scoped>

</style>