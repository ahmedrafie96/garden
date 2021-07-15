<template>
  <header
    id="header"
    :class="`pt-lg-5 pt-md-3 ab pt-2 w-100 ${
      slider ? 'position-absolute' : 'position-relative'
    }`"
  >
    <div
      style="background-image: url(/main/img/images/b-hbdr.jpg)"
      class="container-fluid px-xl-17 px-lg-5 px-md-3 px-0 d-flex flex-wrap"
    >
      <div class="col-6 col-sm-3 col-lg-2 order-sm-2 order-md-0 dis-none">
        <!-- langList -->
        <ul class="nav nav-tabs langList pt-xl-6 pt-lg-4 pt-3 border-bottom-0">
          <li>
            <a
              class="icon-menu"
              data-toggle="dropdown"
              href="javascript:void(0);"
              role="button"
              aria-haspopup="true"
              aria-expanded="false"
            ></a>
            <div class="dropdown-menu pl-4 pr-4">
              <router-link class="dropdown-item" to="/login">{{
                $t("login")
              }}</router-link>
              <router-link class="dropdown-item" to="/register">{{
                $t("register")
              }}</router-link>
              <a class="dropdown-item" href="#" @click="logout">{{
                $t("logout")
              }}</a>
            </div>
          </li>
          <li style="margin: auto" class="dropdown">
            <a
              class="dropdown-toggle text-uppercase"
              data-toggle="dropdown"
              href="javascript:void(0);"
              role="button"
              aria-haspopup="true"
              aria-expanded="false"
              >{{
                this.$store.state.locales.locale == "ar" ? "العربية" : "English"
              }}</a
            >
            <div class="dropdown-menu pl-4 pr-4">
              <a
                @click="changeLocaleToEnglish('en')"
                class="dropdown-item"
                href="javascript:void(0);"
                >English</a
              >
              <a
                @click="changeLocaleToArabic('ar')"
                class="dropdown-item"
                href="javascript:void(0);"
                >العربية</a
              >
              <!-- <a class="dropdown-item" href="javascript:void(0);">French</a> -->
            </div>
          </li>
          <li v-if="$store.state.auth.user != null">
            <a
              style="font-size: 20px"
              class="text-uppercase"
              href="/dashboard"
              role="button"
              aria-haspopup="true"
              aria-expanded="false"
              ><v-icon small> fas fa-tachometer-alt </v-icon></a
            >
          </li>
        </ul>
      </div>
      <div class="col-12 col-sm-6 col-lg-8 static-block">
        <!-- mainHolder -->
        <div class="mainHolder justify-content-center">
          <!-- pageNav1 -->
          <nav
            class="
              navbar navbar-expand-lg navbar-light
              p-0
              pageNav1
              position-static
            "
          >
            <button
              type="button"
              class="navbar-toggle collapsed position-relative mt-md-2"
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
                <li
                  :class="
                    this.$route.name === 'home'
                      ? 'nav-item active dropdown'
                      : 'nav-item  dropdown'
                  "
                >
                  <router-link class="d-block" to="/home"
                    >{{ $t("home") }}
                  </router-link>
                  <!-- <a
                    class=" d-block"
                    role="button"
                  href="/"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >home</a
                  > -->
                </li>

                <li
                  :class="
                    this.$route.name === 'store'
                      ? 'nav-item active'
                      : 'nav-item'
                  "
                >
                  <router-link class="d-block" to="/store"
                    >{{ $t("store") }}
                  </router-link>
                  <!-- <a
                    class="d-block"
                    role="button"
                    href="/store"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >Store</a
                  > -->
                </li>
                <li
                  :class="
                    this.$route.name === 'about'
                      ? 'nav-item active'
                      : 'nav-item'
                  "
                >
                  <router-link class="d-block" to="/about">
                    {{ $t("about") }}
                  </router-link>

                  <!-- <a class="d-block" href="/about">About</a> -->
                </li>
                <li style="text-align: center" class="nav-item">
                  <router-link class="nLogo" to="/" style="text-align: center">
                    <img
                      src="@/main/images/logo.png"
                      alt="Botanical"
                      class="img-fluid"
                      width="64"
                    />
                  </router-link>
                  <!-- <a class="nLogo" href="/"
                    ><img
                      src="@/main/images/logo.png"
                      alt="Botanical"
                      class="img-fluid"
                  /></a> -->
                </li>
                <li
                  :class="
                    this.$route.name === 'blog' ? 'nav-item active' : 'nav-item'
                  "
                >
                  <router-link class="d-block" to="/blog">
                    {{ $t("blog") }}
                  </router-link>

                  <!-- <a
                    class="d-block"
                    role="button"
                    aria-haspopup="true"
                    aria-expanded="false"
                    href="/blog"
                    >Blog</a
                  > -->
                  <!-- <ul
                    class="list-unstyled text-capitalize border-right border-bottom border-left dropdown-menu mt-0 py-0"
                  >
                    <li class="d-block mx-0">
                      <a href="blog">Blog Left Sidebar</a>
                    </li>
                    <li class="d-block mx-0">
                      <a href="blog-detail.html">Blog Detail</a>
                    </li>
                  </ul> -->
                </li>
                <li
                  :class="
                    this.$route.name === 'cart' ? 'nav-item active' : 'nav-item'
                  "
                >
                  <router-link class="d-block" to="/cart">
                    {{ $t("cart") }}
                  </router-link>

                  <!-- <a class="d-block" role="button" href="/cart">Cart Page</a> -->
                </li>
                <li
                  :class="
                    this.$route.name === 'contact-us'
                      ? 'nav-item active'
                      : 'nav-item'
                  "
                >
                  <router-link class="d-block" to="/Contact-Us">
                    {{ $t("contact") }}
                  </router-link>

                  <!-- <a class="d-block" href="Contact-Us">contact</a> -->
                </li>
                <li
                  v-if="this.$vuetify.breakpoint.width < 600"
                  class="dropdown"
                >
                  <a
                    class="dropdown-toggle text-uppercase"
                    data-toggle="dropdown"
                    href="javascript:void(0);"
                    role="button"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >{{ this.$store.state.locales.locale }}</a
                  >
                  <div class="dropdown-menu pl-4 pr-4">
                    <a
                      @click="changeLocaleToEnglish('en')"
                      class="dropdown-item"
                      href="javascript:void(0);"
                      >English</a
                    >
                    <a
                      @click="changeLocaleToArabic('ar')"
                      class="dropdown-item"
                      href="javascript:void(0);"
                      >Arabic</a
                    >
                    <!-- <a class="dropdown-item" href="javascript:void(0);">French</a> -->
                  </div>
                </li>
              </ul>
            </div>
          </nav>
          <div class="logo">
            <a style="width: 64px" href="/"
              ><img
                width="64"
                src="@/main/images/logo.png"
                alt="Botanical"
                style="width: 32px; height: 48px; margin-top: 10px"
            /></a>
          </div>
        </div>
      </div>
      <div class="col-6 col-sm-3 col-lg-2 order-sm-3 order-md-0 dis-none">
        <!-- wishList -->
        <ul
          class="
            nav nav-tabs
            wishList
            pt-xl-5 pt-lg-4 pt-3
            mr-xl-3 mr-0
            justify-content-end
            border-bottom-0
          "
        >
          <li class="nav-item">
            <a class="nav-link icon-search" href="javascript:void(0);"></a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link position-relative icon-heart"
              href="javascript:void(0);"
              ><span class="num rounded d-block">0</span></a
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link position-relative icon-cart" to="/cart"
              ><span class="num rounded d-block">{{
                cart_items
              }}</span></router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </header>
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
  computed: {
    ...mapState({
      cart_items: (state) => state.cart.counter,
      result: (state) => state.search.result,
      available_locales: (state) => state.locales.available_locales,
    }),
    slider() {
      return this.$route.name == "Home" || this.$route.name == "home";
    },
  },
  methods: {
    changeLocaleToArabic(val) {
      this.$vuetify.rtl = true;
      localStorage.setItem("rtl", true);
      this.$store.dispatch("locales/change", val);
      this.$i18n.locale = val;
      localStorage.setItem("locale", val);
      location.reload();
    },
    changeLocaleToEnglish(val) {
      this.$vuetify.rtl = false;
      localStorage.setItem("rtl", false);
      this.$store.dispatch("locales/change", val);
      this.$i18n.locale = val;
      localStorage.setItem("locale", val);
      location.reload();
    },
    logout() {
      this.$store.dispatch("auth/unload");
      location.reload();
    },
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
</style>