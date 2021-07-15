<template>
  <aside
    class="
      footerHolder
      container-fluid
      overflow-hidden
      px-xl-20 px-lg-14
      pt-xl-12
      pb-xl-8
      pt-lg-12 pt-md-8 pt-10
      pb-lg-8
    "
    :style="`text-align:start;${!home ? 'background:#f5f5f5' : ''}`"
  >
    <div class="d-flex flex-wrap flex-lg-nowrap">
      <div class="coll-1 pr-3 mb-sm-4 mb-3 mb-lg-0">
        <h3
          style="text-align: start"
          class="headingVI fwEbold text-uppercase mb-7"
        >
          {{ $t("Contact Us") }}
        </h3>
        <ul class="list-unstyled footerContactList mb-3">
          <li class="mb-3 d-flex flex-nowrap">
            <span class="icon icon-place mr-3"></span>
            <address class="fwEbold m-0">
              {{ $t("Gaza ، Al-Rashed-Street ، Al-Forqan-Crossroads") }}
            </address>
          </li>
          <li class="mb-3 d-flex flex-nowrap">
            <span class="icon icon-phone mr-3"></span>
            <span class="leftAlign"
              >{{ $t("phone") }} :
              <router-link to="javascript:void(0);"
                >+970595260061
              </router-link></span
            >
          </li>
          <li class="email d-flex flex-nowrap">
            <span class="icon icon-email mr-2"></span>
            <span class="leftAlign"
              >{{ $t("email") }}:
              <router-link to="javascript:void(0);"
                >info@planttree.ps</router-link
              ></span
            >
          </li>
        </ul>
        <ul class="list-unstyled followSocailNetwork d-flex flex-nowrap">
          <li class="fwEbold mr-xl-11 mr-sm-6 mr-4">{{ $t("Follow us") }}:</li>
          <li class="mr-xl-6 mr-sm-4 mr-2">
            <a href="https://www.facebook.com/tree.palestine/" class="fab fa-facebook-f">
              @tree.palestine</a
            >
          </li>
          <!-- <li class="mr-xl-6 mr-sm-4 mr-2">
                <router-link to="javascript:void(0);" class="fab fa-twitter"></router-link >
              </li>
              <li class="mr-xl-6 mr-sm-4 mr-2">
                <router-link to="javascript:void(0);" class="fab fa-pinterest"></router-link >
              </li>
              <li class="mr-2">
                <router-link to="javascript:void(0);" class="fab fa-google-plus-g"></router-link >
              </li> -->
        </ul>
      </div>
      <div class="coll-2 mb-sm-4 mb-3 mb-lg-0">
        <h3 class="headingVI fwEbold text-uppercase mb-6">
          {{ $t("Information") }}
        </h3>
        <ul class="list-unstyled footerNavList">
          <li class="mb-1">
            <router-link to="/store">{{ $t("Available Items") }}</router-link>
          </li>
          <li class="mb-2">
            <router-link to="/friends">{{ $t("friends_page") }}</router-link>
          </li>
          <li class="mb-2">
            <router-link to="/blog">{{ $t("Latest Posts") }}</router-link>
          </li>
          <li class="mb-2">
            <router-link to="/contact-us">{{ $t("Our Position") }}</router-link>
          </li>
        </ul>
      </div>
      <div class="coll-3 mb-sm-4 mb-3 mb-lg-0">
        <h3 class="headingVI fwEbold text-uppercase mb-6">
          {{ $t("our_pages") }}
        </h3>
        <ul class="list-unstyled footerNavList">
          <li class="mb-1">
            <router-link to="/home">{{ $t("home") }}</router-link>
          </li>
          <li class="mb-2">
            <router-link to="/blog">{{ $t("blog") }}</router-link>
          </li>
          <li class="mb-2">
            <router-link to="/contact-us">{{ $t("contact") }}</router-link>
          </li>
          <li>
            <router-link to="/store">{{ $t("store") }}</router-link>
          </li>
        </ul>
      </div>
      <div class="coll-4 mb-sm-4 mb-3 mb-lg-0">
        <h3 class="headingVI fwEbold text-uppercase mb-7 pl-xl-14 pl-lg-10">
          {{ $t("Popular Tag") }}
        </h3>
        <ul
          class="
            list-unstyled
            tagNavList
            d-flex
            flex-wrap
            justify-content-lg-end
            mb-0
          "
        >
          <li class="text-center mb-2 mr-2">
            <router-link
              to="javascript:void(0);"
              class="md-round d-block py-2 px-2"
              >Trend</router-link
            >
          </li>
          <li class="text-center mb-2">
            <router-link
              to="javascript:void(0);"
              class="md-round d-block py-2 px-2"
              >Palestine</router-link
            >
          </li>
          <li class="text-center mb-2 mr-2">
            <router-link
              to="javascript:void(0);"
              class="md-round d-block py-2 px-2"
              >Plant</router-link
            >
          </li>
          <li class="text-center mb-2">
            <router-link
              to="javascript:void(0);"
              class="md-round d-block py-2 px-2"
              >Table tree</router-link
            >
          </li>
          <li class="text-center mb-2 mr-2">
            <router-link
              to="javascript:void(0);"
              class="md-round d-block py-2 px-2"
              >Tree</router-link
            >
          </li>
          <li class="text-center mb-2 mr-2">
            <router-link
              to="javascript:void(0);"
              class="md-round d-block py-2 px-2"
              >Plant Tree</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </aside>
</template>

<script>
export default {
  props: ["home"],
};
</script>

<style>
</style>