<template>
  <main>
    <!-- introBannerHolder -->
    <!-- introBannerHolder -->
    <intro-banner-holder :title="$t('store')"  />

    <!-- twoColumns -->
    <div
      class="twoColumns container pt-lg-23 pb-lg-20 pt-md-16 pb-md-4 pt-10 pb-4"
    >
      <div class="row">
        <div class="col-12 col-lg-9 order-lg-3">
          <!-- content -->
          <article v-if="showType == true" id="content">
            <!-- show-head -->
            <header
              class="show-head d-flex flex-wrap justify-content-between mb-7"
            >
              <ul
                v-if="$vuetify.breakpoint.width > 600"
                class="
                  list-unstyled
                  viewFilterLinks
                  d-flex
                  flex-nowrap
                  align-items-center
                "
              >
                <li class="mr-2 active">
                  <v-btn
                    @click="showType = true"
                    elevation="2"
                    class="active"
                    icon
                  >
                    <v-icon color="green"> fas fa-th-large </v-icon>
                  </v-btn>
                </li>

                <li class="mr-2 active">
                  <v-btn
                    @click="showType = false"
                    elevation="2"
                    exact
                    class="active"
                    icon
                  >
                    <v-icon color="black"> fas fa-list </v-icon>
                  </v-btn>
                </li>
                <!-- <li class="mr-2 "><a href="javascript:void(0);" class="active"><i class="fas fa-th-large"></i></a></li>
									<li class="mr-2 active"><a href="javascript:void(0);"><i class="fas fa-list active"></i></a></li> -->
                <li class="mr-2">Showing 1–9 of 24 results</li>
              </ul>
              <!-- sortGroup -->
              <div class="sortGroup">
                <div>
                  <strong class="groupTitle mr-2 mb-4"
                    >{{ $t("sort_by") }}:</strong
                  >
                  <div>
                    <v-select
                      dense
                      outlined
                      :items="categories"
                      item-text="name"
                      item-value="id"
                      v-model="params.categories"
                      :label="$t('category')"
                      attach
                      chips
                      multiple
                    ></v-select>
                  </div>
                </div>
              </div>
            </header>
            <div class="row">
              <!-- featureCol -->
              <div
                v-for="(item, a) in items"
                :key="a"
                class="col-12 col-sm-6 col-lg-4 featureCol mb-7"
              >
                <div class="border">
                  <div
                    class="imgHolder position-relative w-100 overflow-hidden"
                  >
                    <span
                      class="
                        hotOffer
                        fwEbold
                        text-uppercase text-white
                        position-absolute
                        d-block
                      "
                      >HOT</span
                    >
                    <span
                      class="
                        hotOffer
                        green
                        fwEbold
                        text-uppercase text-white
                        position-absolute
                        d-block
                        ml-8
                      "
                      >Sale</span
                    >

                    <img
                      style="height: 265px"
                      :src="item.image.url"
                      alt="image description"
                      class="img-fluid w-100"
                    />
                    <ul
                      class="
                        list-unstyled
                        postHoverLinskList
                        d-flex
                        justify-content-center
                        m-0
                      "
                    >
                      <li class="mr-2 overflow-hidden">
                        <a
                          href="javascript:void(0);"
                          class="icon-heart d-block"
                        ></a>
                      </li>
                      <li @click="addItem(item)" class="mr-2 overflow-hidden">
                        <a
                          href="javascript:void(0);"
                          class="icon-cart d-block"
                        ></a>
                      </li>
                      <li class="mr-2 overflow-hidden">
                        <router-link
                          :to="`product/${item.id}`"
                          class="icon-eye d-block"
                        ></router-link>
                      </li>
                      <li class="overflow-hidden">
                        <a
                          href="javascript:void(0);"
                          class="icon-arrow d-block"
                        ></a>
                      </li>
                    </ul>
                  </div>
                  <div class="text-center py-5 px-4">
                    <span class="title d-block text-capitalize mb-2"
                      ><router-link :to="`product/${item.id}`">{{
                        item.name
                      }}</router-link></span
                    >
                    <span class="price d-block fwEbold"
                      >{{ item.price }} $</span
                    >
                  </div>
                </div>
              </div>

              <div class="col-12 pt-3 mb-lg-0 mb-md-6 mb-3">
                <!-- pagination -->
                <pagination
                  :meta="meta"
                  @paginated="
                    (v) => $store.dispatch('item/changeCurrentPage', v)
                  "
                  class="col-12 pt-3 mb-lg-0 mb-md-6 mb-3"
                />
              </div>
            </div>
          </article>

          <!-- we are working here rghit now -->
          <!-- we are working here rghit now -->
          <!-- we are working here rghit now -->
          <!-- we are working here rghit now -->
          <!-- we are working here rghit now -->

          <article v-if="showType == false" id="content">
            <!-- show-head -->
            <header
              class="show-head d-flex flex-wrap justify-content-between mb-7"
            >
              <ul
                v-if="$vuetify.breakpoint.width > 600"
                class="
                  list-unstyled
                  viewFilterLinks
                  d-flex
                  flex-nowrap
                  align-items-center
                "
              >
                <li class="mr-2 active">
                  <v-btn
                    @click="showType = true"
                    elevation="2"
                    class="active"
                    icon
                  >
                    <v-icon color="black"> fas fa-th-large </v-icon>
                  </v-btn>
                </li>

                <li @click="showType = false" class="mr-2 active">
                  <v-btn elevation="2" exact class="active" icon>
                    <v-icon color="green"> fas fa-list </v-icon>
                  </v-btn>
                </li>
                <!-- <li class="mr-2 "><a href="javascript:void(0);" class="active"><i class="fas fa-th-large"></i></a></li>
									<li class="mr-2 active"><a href="javascript:void(0);"><i class="fas fa-list active"></i></a></li> -->
                <li class="mr-2">Showing 1–9 of 24 results</li>
              </ul>
              <!-- sortGroup -->
              <div class="sortGroup">
                <div>
                  <strong class="groupTitle mr-2 mb-4"
                    >{{ $t("sort_by") }}:</strong
                  >
                  <div>
                    <v-select
                      dense
                      outlined
                      :items="categories"
                      item-text="name"
                      item-value="id"
                      v-model="params.categories"
                      :label="$t('category')"
                      attach
                      chips
                      multiple
                    ></v-select>
                  </div>
                </div>
              </div>
            </header>

            <v-container>
              <div class="row">
                <v-container>
                  <!-- featureCol -->
                  <!-- <div  class="col-12 col-sm-6 col-lg-4 featureCol mb-7">
							
									<div class="border">
										<div class="imgHolder position-relative w-100 overflow-hidden">
											<span class="hotOffer fwEbold text-uppercase text-white position-absolute d-block">HOT</span>
											<span class="hotOffer green fwEbold text-uppercase text-white position-absolute d-block ml-8">Sale</span>

											<img style="height:265px;" :src="item.image.url" alt="image description" class="img-fluid w-100">
											<ul class="list-unstyled postHoverLinskList d-flex justify-content-center m-0">
												<li class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-heart d-block"></a></li>
												<li   @click="addItem(item)" class="mr-2 overflow-hidden"><a href="javascript:void(0);" class="icon-cart d-block"></a></li>
												<li class="mr-2 overflow-hidden"><router-link :to="`product/${item.id}`" class="icon-eye d-block"></router-link></li>
												<li class="overflow-hidden"><a href="javascript:void(0);" class="icon-arrow d-block"></a></li>
											</ul>
										</div>
										<div class="text-center py-5 px-4">
											<span class="title d-block text-capitalize mb-2"><router-link :to="`product/${item.id}`">{{item.name}}</router-link ></span>
											<span class="price d-block fwEbold">{{item.price}} $</span>
										</div>
									</div>
								</div> -->

                  <v-row
                    style="width: 100%"
                    v-for="(item, a) in items"
                    :key="a"
                  >
                    <v-col cols="4">
                      <router-link :to="`product/${item.id}`">
                        <v-img
                          width="267"
                          style="height: 230px"
                          class="img-fluid w-100"
                          :src="item.image.url"
                        >
                        </v-img>
                      </router-link>
                    </v-col>
                    <v-col align-self="center" cols="2">
                      <div class="text-center py-5 px-4">
                        <span class="title d-block text-capitalize mb-2"
                          ><router-link :to="`product/${item.id}`">{{
                            item.name
                          }}</router-link></span
                        >
                        <span class="price d-block fwEbold"
                          >{{ item.price }} $</span
                        >
                      </div>
                    </v-col>
                    <v-col align-self="center" cols="6">
                      <v-row>
                        <v-col style="padding: 0px" align-self="center">
                          <v-card flat>
                            <v-card-title style="padding: 0px; margin: 0px">
                              <span
                                style="font-size: 16px"
                                v-html="item.description"
                                class="heading"
                              ></span>
                            </v-card-title>
                          </v-card>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col style="padding: 0px" align-self="center">
                          <ul
                            class="
                              list-unstyled
                              postHoverLinskList
                              d-flex
                              justify-content-center
                              m-0
                            "
                          >
                            <li class="mr-2">
                              <a
                                href="javascript:void(0);"
                                class="icon-heart d-block"
                              ></a>
                            </li>
                            <li @click="addItem(item)" class="mr-2">
                              <a
                                href="javascript:void(0);"
                                class="icon-cart d-block"
                              ></a>
                            </li>
                            <li class="mr-2">
                              <router-link
                                :to="`product/${item.id}`"
                                class="icon-eye d-block"
                              ></router-link>
                            </li>
                          </ul>
                        </v-col>
                      </v-row>
                    </v-col>
                  </v-row>

                  <div class="col-12 pt-3 mb-lg-0 mb-md-6 mb-3">
                    <!-- pagination -->
                    <pagination
                      :meta="meta"
                      @paginated="
                        (v) => $store.dispatch('item/changeCurrentPage', v)
                      "
                      class="col-12 pt-mb-lg-0 mb-md-6 mb-3"
                    />
                  </div>
                </v-container>
              </div>
            </v-container>
          </article>
        </div>

        <div class="col-12 col-lg-3 order-lg-1">
          <!-- sidebar -->
          <aside id="sidebar">
            <!-- widget search -->
            <section class="widget overflow-hidden mb-9">
              <form
                action="javascript:void(0);"
                class="searchForm position-relative border"
              >
                <fieldset>
                  <input
                    v-model="params.name"
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

            <!-- widget PRODUCT CATEGORIES -->
            <section class="widget overflow-hidden mb-9">
              <h3 class="headingVII fwEbold text-uppercase mb-5">
                {{ $t("PRODUCT_CATEGORIES") }}
              </h3>
              <ul class="list-unstyled categoryList mb-0">
                <li
                  @click="categoryFiltering(category.id)"
                  :key="i"
                  v-for="(category, i) in categories"
                  class="mb-5 overflow-hidden"
                >
                  <a href="javascript:void(0);"
                    >{{ category.name }}
                    <span class="num border float-right">{{
                      category.item_count
                    }}</span></a
                  >
                </li>
              </ul>
            </section>

            <!-- widget FILTER BY PRICE -->
            <section class="widget mb-9">
              <h3 class="headingVII fwEbold text-uppercase mb-6">
                {{ $t("filter_by_price") }}
              </h3>
              <!-- filter ranger form -->

              <v-card flat color="transparent">
                <v-card-text>
                  <v-row>
                    <v-range-slider
                      color="#5BA515"
                      v-model="range"
                      :max="max"
                      :min="min"
                      hide-details
                      class="align-center"
                    >
                    </v-range-slider>
                  </v-row>
                  <v-row>
                    <v-col>
                      <v-btn
                        class="rangeFilterBtn"
                        dark
                        color="#5BA515"
                        rounded
                        @click="rangeFiltering"
                        >{{ $t("filter") }}
                      </v-btn>
                    </v-col>
                    <v-col>
                      <v-text-field
                        suffix="$"
                        :value="range[0]"
                        class="mt-0 pt-0"
                        hide-details
                        single-line
                        @change="$set(range, 0, $event)"
                      ></v-text-field>
                    </v-col>
                    <v-col>
                      <v-text-field
                        suffix="$"
                        :value="range[1]"
                        class="mt-0 pt-0"
                        hide-details
                        single-line
                        @change="$set(range, 1, $event)"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-card-text>
              </v-card>

              <!-- 
									<v-range-slider
									  dense
									  :hint="range[2]"
									  max="1000"
									  min="0"
									  v-model="range"
									></v-range-slider> -->
              <!-- 								
								<form action="javascript:void(0);" class="filter-ranger-form">
									<div id="slider-range"></div>
									<input v-model="amount1" type="hidden" id="amount1" name="amount1">
									<input v-model="amount2" type="hidden" id="amount2" name="amount2">
									<div class="get-results-wrap d-flex align-items-center justify-content-between">
										<button type="button" class="btn btnTheme btn-shop fwEbold md-round px-3 pt-1 pb-2 text-uppercase">Filter</button>
										<p id="amount" class="mb-0"></p>
									</div>
								</form> -->
            </section>
            <!-- widget TOP RATE -->
            <section class="widget">
              <h3 class="headingVII fwEbold text-uppercase mb-6">
                {{ $t("top_rate") }}
              </h3>
              <ul class="list-unstyled recentListHolder mb-0 overflow-hidden">
                <li
                  v-for="(item, index) in items"
                  :key="index"
                  class="mb-6 d-flex flex-nowrap"
                >
                  <template v-if="index <= 6">
                    <div class="alignleft">
                      <router-link :to="`product/${item.id}`"
                        ><img
                          :src="item.image.url"
                          alt="image description"
                          class="img-fluid"
                      /></router-link>
                    </div>
                    <div class="description-wrap pl-1">
                      <h4 class="headingVII mb-1 text-capitalize">
                        <router-link :to="`product/${item.id}`"
                          >{{ item.name }}
                        </router-link>
                      </h4>
                      <strong class="price fwEbold d-block;"
                        >{{ item.price }} $</strong
                      >
                    </div>
                  </template>
                </li>
              </ul>
            </section>
            <!-- widget  tags -->
            <section class="widget mb-9">
              <h3 class="headingVII fwEbold text-uppercase mb-5">
                product tags
              </h3>
              <ul class="list-unstyled tagNavList d-flex flex-wrap mb-0">
                <li :key="i" v-for="(tag, i) in tags" class="text-center">
                  <a href="javascript:void(0);" class="md-round d-block">{{
                    tag.name
                  }}</a>
                </li>
                <!-- <li class="text-center"><a href="javascript:void(0);" class="md-round d-block">tag.id</a></li>
									<li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Indoor</a></li>
									<li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Green</a></li>
									<li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Healthy</a></li>
									<li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Cactus</a></li>
									<li class="text-center"><a href="javascript:void(0);" class="md-round d-block">House plant</a></li>
									<li class="text-center"><a href="javascript:void(0);" class="md-round d-block">Office tree</a></li> -->
              </ul>
            </section>
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

  <!-- <main>
			<pre></pre>
			<pre></pre>
			<two-columns />
		</main> -->
</template>
<script>
import { mapActions, mapState } from "vuex";
export default {
  data() {
    return {
      showType: true,
      min: 0,
      max: 1000,
      range: [50, 500],
      cart: [],
      params: {},
    };
  },

  mounted() {
    this.$store.dispatch("item/index");
    this.$store.dispatch("category/index");
    this.$store.dispatch("tag/index");
    window.scrollTo(0,0);
  },
  methods: {
    ...mapActions("cart", ["addItem"]),
    rangeFiltering() {
      this.$store.dispatch("item/index", { price: this.range });
    },
    categoryFiltering(id) {
      this.$store.dispatch("item/index", { categories: [id] });
    },
  },
  computed: {
    ...mapState({
      items: (state) => state.item.all,
      categories: (state) => state.category.all,
      meta: (state) => state.item.meta,
      tags: (state) => state.tag.all,
    }),
  },
  watch: {
    params: {
      handler(val) {
        this.$store.dispatch("item/index", val);
      },
      deep: true,
    },
    items() {
      setTimeout(() => {
        $(function () {
          $("#slider-range").slider({
            range: true,
            min: 0,
            max: 1000,
            values: [0, 500],
            slide: function (event, ui) {
              $("#amount").html(
                "Price : $" + ui.values[0] + " - $" + ui.values[1]
              );
              $("#amount1").val(ui.values[0]);
              $("#amount2").val(ui.values[1]);
            },
          });
          $("#amount").html(
            "Price : $" +
              $("#slider-range").slider("values", 0) +
              " - $" +
              $("#slider-range").slider("values", 1)
          );

          $("#amount1").val($("#slider-range").slider("values", 0));
          $("#amount2").val($("#slider-range").slider("values", 1));
        });
      }, 15);
    },
  },
};
</script>


<style scoped>

.rangeFilterBtn {
  color: white;
  font-weight: 700;
}
</style>