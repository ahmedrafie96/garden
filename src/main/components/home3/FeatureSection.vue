<template>
  <section
    v-if="items.length > 0"
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
  >
    <!-- mainHeader -->
    <header class="col-12 mainHeader mb-7 text-center">
      <h1 class="headingIV playfair fwEblod mb-4">
        {{ $t("featured_items") }}
      </h1>
      <span class="headerBorder d-block mb-5"
        ><img
          src="@/main/images/hbdr.png"
          alt="Header Border"
          class="img-fluid img-bdr"
      /></span>
    </header>
    <v-row>
      <v-col cols="12" md="4" v-for="item in items" :key="item.id">
        <product @added_to_cart="addItem(item)" :item="item" />
      </v-col>
    </v-row>
  </section>
</template>

<script>
import { mapActions } from "vuex";

export default {
  props: {
    items: {
      default: () => {
        return [];
      },
    },
  },
  methods: {
    ...mapActions("cart", ["addItem"]),
  },
};
</script>

<style>
</style>