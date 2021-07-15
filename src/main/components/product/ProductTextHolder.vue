<template>
  <div>
    <!-- productTextHolder -->
    <div  class="productTextHolder overflow-hidden mt-10">
      <h2 class="fwEbold mb-2">{{ item.name }}</h2>

      <strong class="price d-block mb-5 text-green">{{ item.price }} $</strong>

      <ul class="list-unstyled productInfoDetail mb-5 overflow-hidden">
        <li class="mb-2">
          {{ $t("code") }}: <span>{{ item.code }}</span>
        </li>
      </ul>
      <div>
        <button
          @click="addItem(item)"
          class="
            btn
            btnTheme
            btnShop
            fwEbold
            text-white
            md-round
            py-3
            px-4
            py-md-3
            px-md-4
          "
        >
          {{ $t("add_to_cart") }} <i :class="`fas fa-arrow-${$vuetify.rtl?'left':'right'} m${$vuetify.rtl?'r':'l'}-2 float-${$vuetify.rtl?'left':'right'}`"></i>
        </button>
      </div>
      <ul   class="list-unstyled socialNetworkList d-flex mt-10">
        <li class="text-uppercase mr-12">{{ $t("share_this_item") }}:</li>
        <li class="mr-4">
          <ShareNetwork
            network="facebook"
            :url="document.location.href"
            :title="item.name"
          >
            <a href="javascript:void(0);" class="fab fa-facebook-f"></a>
          </ShareNetwork>
        </li>
        <li class="mr-4">
          <ShareNetwork
            network="twitter"
            :url="document.location.href"
            :title="item.name"
          >
            <a href="javascript:void(0);" class="fab fa-twitter"></a>
          </ShareNetwork>
        </li>
      </ul>
      <!-- <ul class="list-unstyled productInfoDetail mb-0">
        <li class="mb-2">
          Categories: <a href="javascript:void(0);">Butter &amp; Eggs,</a>
          <a href="javascript:void(0);">Fruits,</a>
          <a href="javascript:void(0);">Milk &amp; Cream,</a>
          <a href="javascript:void(0);">Vegetables</a>
        </li>
        <li class="mb-2">
          Tags: <a href="javascript:void(0);">organic food,</a>
          <a href="javascript:void(0);">fruits,</a>
          <a href="javascript:void(0);">juice</a>
        </li>
        <li>Brand: <a href="javascript:void(0);">KFC</a></li>
      </ul> -->
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  props: ["item"],
  methods: {
    ...mapActions("cart", ["addItem"]),
  },
  data() {
    return {
      document,
    };
  },
};
</script>

<style>
</style>