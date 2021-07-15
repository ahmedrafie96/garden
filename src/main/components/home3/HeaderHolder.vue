<template>
  <div class="headerHolder container pt-lg-5 pb-lg-7 py-4">
    <div class="row" style="align-items: center">
      <div class="col-6 col-sm-2">
        <!-- mainLogo -->
        <div class="logo">
          <router-link to="/"
            ><img
              src="@/main/images/logo.png"
              :alt="$t('plant_a_tree')"
              class="img-fluid"
          /></router-link>
        </div>
      </div>

      <div class="col-6 col-sm-7 col-lg-8 static-block">
        <!-- mainHolder -->
        <div class="mainHolder pt-lg-5 pt-3 justify-content-center">
          <!-- pageNav2 -->
          <nav
            class="
              navbar navbar-expand-lg navbar-light
              p-0
              pageNav2
              position-static
            "
          >
            <button
              type="button"
              class="navbar-toggle collapsed position-relative"
              data-toggle="collapse"
              data-target="#navbarNav"
              aria-expanded="false"
            >
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav mx-auto text-uppercase d-inline-block">
                <pre></pre>
                <pre></pre>
                <pre></pre>
                <li class="nav-item dropdown">
                  <router-link
                    to="/"
                    class="dropdown-toggle d-block nav-link1"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >{{ $t("home") }}</router-link
                  >
                </li>
                <li class="nav-item dropdown">
                  <router-link
                    class="dropdown-toggle d-block nav-link1"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    to="/store"
                    >{{ $t("store") }}</router-link
                  >
                </li>

                <li class="nav-item">
                  <router-link class="d-block nav-link1" to="/about">{{
                    $t("about")
                  }}</router-link>
                </li>
                <li class="nav-item dropdown">
                  <router-link
                    class="dropdown-toggle d-block nav-link1"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    to="/blog"
                    >{{ $t("blog") }}</router-link
                  >
                </li>

                <li class="nav-item">
                  <router-link class="d-block nav-link1" to="/contact-us">{{
                    $t("contact")
                  }}</router-link>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
      <div class="col-sm-3 col-lg-2">
        <v-row class="pt-5" justify="start" dense>
          
          <v-col
            v-if="$store.state.auth.user != null"
            align-self="left"
            cols="3"
          >
            <v-btn icon href="/dashboard"
              ><v-icon color="blue">fas fa-tools</v-icon></v-btn
            ></v-col
          >
          <v-col v-if="$store.state.auth.user != null" cols="3">
            <v-btn icon to="/cart">
              <v-badge overlap color="red" :content="cart_items">
                <v-icon color="blue">icon-cart</v-icon>
              </v-badge>
            </v-btn>
          </v-col>
          <v-col v-else cols="3">
            <v-btn icon to="/login">
              <v-icon color="blue">mdi-login</v-icon>
            </v-btn>
          </v-col>
          <v-col v-if="$vuetify.breakpoint.width > 775" cols="3">
            <v-btn icon>
              <v-icon color="blue">fas fa-search</v-icon>
            </v-btn>
          </v-col>
          <v-col cols="3">
            <v-menu offset-y>
              <template v-slot:activator="{ on, attrs }">
                <v-btn color="primary" dark v-bind="attrs" v-on="on" icon>
                  <v-icon> fas fa-globe </v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-item @click="changeLocaleToArabic('ar')">
                  <v-list-item-title>العربية</v-list-item-title>
                </v-list-item>
                <v-list-item @click="changeLocaleToEnglish('en')">
                  <v-list-item-title>English</v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
          </v-col>
        </v-row>

        <!-- <ul class="nav nav-tabs wishListII pt-5">
          
          <li class="nav-item ml-0"  v-if="$store.state.auth.user != null">
            <a href="/dashboard" class="nav-link">
              <i class="fas fa-tools"></i>
            </a>
          </li>

          <li class="nav-item">
            <router-link
              to="/cart"
              class="nav-link position-relative icon-cart"
              href="javascript:void(0);"
              ><span class="num rounded d-block">{{
                cart_items
              }}</span></router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link icon-search" @click="search_dialog = true"></a>
          </li>
        </ul> -->
      </div>
    </div>

    <v-overlay :value="search_dialog">
      <v-card
        color="transparent"
        style="width: 100vw !important; height: 100vh !important"
      >
        <v-card-actions>
          <v-btn icon @click="search_dialog = false">
            <v-icon> fas fa-times </v-icon>
          </v-btn>
        </v-card-actions>
        <v-card-text>
          <v-row justify="center">
            <v-col cols="12" md="8">
              <v-text-field
                :label="$t('search')"
                @input="(v) => $store.dispatch('search/index', { search: v })"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row v-if="result.items.length > 0">
            <v-col cols="12">
              <v-card color="transparent">
                <v-card-title>
                  {{ $t("items") }}
                </v-card-title>
                <v-card-text>
                  <v-card v-for="item in result.items" :key="item.id">
                    <v-card-title>
                      {{ item.name }}
                    </v-card-title>
                  </v-card>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
          <v-divider></v-divider>
          <v-row v-if="result.posts.length > 0">
            <v-col cols="12">
              <v-card color="transparent">
                <v-card-title>
                  {{ $t("posts") }}
                </v-card-title>
                <v-card-text> </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-overlay>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  data() {
    return {
      rtl: true,
      items: [],
      search_dialog: false,
    };
  },
  methods: {
    // ToLtr() {
    //   this.rtl = true;
    // },
    // ToRtl() {
    //   this.rtl = false;
    // },
    // changeLocaleToArabic(val) {
    //   this.rtl = true;
    //   this.$store.dispatch("locales/change", val);
    //   this.$i18n.locale = val;
    //   localStorage.setItem("locale", val);
    //   location.reload();
    // },
    // changeLocaleToEnglish(val) {
    //   this.rtl = false;
    //   this.$store.dispatch("locales/change", val);
    //   this.$i18n.locale = val;
    //   localStorage.setItem("locale", val);
    //   location.reload();
    // },
  },
  computed: {
    ...mapState({
      cart_items: (state) => state.cart.counter,
      result: (state) => state.search.result,
      available_locales: (state) => state.locales.available_locales,
    }),
  },
  watch: {
    // rtl: {
    //   handler(newval, oldval) {
    //     this.$vuetify.rtl = newval;
    //     localStorage.setItem("rtl", newval);
    //   },
    // },
  },
};
</script>

<style>
/* 
        <v-row>
          <v-col v-if="$store.state.auth.user != null"
            ><a href="/dashboard"><v-icon>fas fa-tools</v-icon></a></v-col
          >
          <v-col class="nav-item">
            <router-link
              to="/cart"
              class="nav-link position-relative icon-cart"
              href="javascript:void(0);"
              ><span class="num rounded d-block">{{
                cart_items
              }}</span></router-link
            >
          </v-col>
          <v-col
            ><a href=""><v-icon>icon-search</v-icon></a></v-col
          >
        </v-row> */
</style>