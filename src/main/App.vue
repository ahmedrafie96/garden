<template>
  <v-app>
    <!-- pageWrapper -->
    <div id="pageWrapper" :dir="rtl ? 'rtl' : 'ltr'">
      <!-- header -->
      <header id="header" :class="`position-${home ? 'absolute' : 'relative'}`">
        <!-- headerHolderCol -->
        <!-- <header-holder-col v-if="logged_in" /> -->
        <!-- headerHolder -->
        <!-- <header-holder /> -->
        <ha-site-header />
      </header>
      <!-- main -->
      <router-view />
      <!-- footer -->
      <!-- <footer-holder /> -->
      <ha-footer-holder :home="home" />

      <site-footer />
    </div>
    <v-overlay :value="$store.state.overlay">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>
    <v-overlay
      :timeout="-1"
      :value="$store.state.get_alert"
      top
      centered
      justify-center
      dark
      fullscreen
      color="#393939"
      opacity="1"
    >
      <v-row justify="center">
        <v-progress-circular indeterminate size="48"></v-progress-circular>
      </v-row>
      <v-row> {{$t('loading')}} </v-row>
    </v-overlay>
    <v-snackbar
      :timeout="2000"
      :value="$store.state.post_alert"
      top
      centered
      justify-center
      dark
      color="green"
      class="elevation-0"
    >
      <v-row justify="center">
        {{ $t("process_done_successfully") }}
      </v-row>
    </v-snackbar>
    <v-snackbar
      :timeout="$store.state.error_timeout"
      :value="$store.state.post_fail_alert"
      top
      centered
      justify-center
      dark
      color="red"
      class="elevation-0"
    >
      <v-row justify="center">
        <ul>
          <li v-for="error in Object.keys($store.state.errors)" :key="error">
            {{ $store.state.errors[error].reduce((c, n) => c + n + "\n") }}
          </li>
        </ul>
      </v-row>
    </v-snackbar>
  </v-app>
</template>

<script>
import { mapState } from "vuex";
export default {
  name: "App",

  data: () => ({
    logged_in: false,
  }),
  mounted() {
    import("./js/jqueryCustome");
    if (!this.logged_in) {
      // this.$router.redirect("/login");
    }
    this.$vuetify.rtl = this.$store.state.rtl;
    this.$vuetify.locale = this.locale;
    this.$i18n.locale = this.locale;

    window.FB.getLoginStatus(function (response) {
      console.log(response);
    });
  },
  updated() {},
  computed: {
    ...mapState({
      redirect: (state) => state.auth.redirect,
      locale: (state) => state.locales.locale,
      rtl: (state) => state.rtl,
    }),

    home() {
      return (
        this.$route.name == "Home" ||
        (this.$route.name == "home" && this.$vuetify.breakpoint.width > 600)
      );
    },
  },
  components: {
    DashboardCoreSettings: () => import("@/dashboard/components/core/Settings"),
  },
  watch: {
    redirect: function (val) {
      console.log(val);
      if (val != "customer") this.$router.push("/dashboard");
    },
    locale: function (val) {
      this.$vuetify.locale = val;
      this.$i18n.locale = val;
    },
    rtl: function (val) {
      this.$vuetify.rtl = val;
    },
  },
};
</script>
<style >
@import url("./css/bootstrap.css");
@import url("./css/fontawesome.css");
@import url("./css/style.css");
@import url("./css/plugins.css");
@import url("./css/color.css");
@import url("./css/responsive.css");
@import url("https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap");
.row {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}
@import url('https://fonts.googleapis.com/css2?family=El+Messiri:wght@500&display=swap');
p,
artical,
h1,
h2,
h3,
h4,
h5,
h6,
div,
strong,
address,
v-html {
  font-family: "Cairo", sans-serif;
}
#pageWrapper[dir="rtl"] p,
#pageWrapper[dir="rtl"] div,
#pageWrapper[dir="rtl"] a {
  text-align: right;
}
#pageWrapper[dir="rtl"] .slickNums,
#pageWrapper[dir="rtl"] .slickNavigatorsWrap{
  right:130px !important;
  direction: ltr !important;
}
#pageWrapper[dir="rtl"] .slickNavigatorsWrap a,
#pageWrapper[dir="rtl"] .slickNums a{
  text-align: center !important;
  direction : ltr !important;
}
#pageWrapper[dir="ltr"] .nav-item{
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
}
#pageWrapper[dir="ltr"] {
  font-family: "Playfair Display", serif !important;
}
.num{
  text-align: center;
}
</style>
