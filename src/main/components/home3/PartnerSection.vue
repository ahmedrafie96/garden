<template>
  <div
    class="partnerSec container overflow-hidden py-xl-12 py-lg-10 py-md-8 py-5"
	v-if="partners.length>0"
  >
    <div class="row">
      <!-- mainHeader -->
      <header class="col-12 mainHeader mb-4 text-center">
        <h1 class="headingIV playfair fwEblod mb-6">
          {{ $t("our_partners") }}
        </h1>
        <span class="headerBorder d-block mb-5"
          ><img
            src="@/main/images/hbdr.png"
            alt="Header Border"
            class="img-fluid img-bdr"
        /></span>
      </header>
    </div>
    <div class="row">
      <div class="col-12">
        <!-- partnerSlider -->
        <div class="partnerSlider d-flex flex-wrap">
          <div v-for="partner in partners">
            <div
            style="margin:15px;height:150px;"
              class="logoColumn d-flex align-items-center justify-content-center"
            >
              <a :href="partner.link" target="_blank" :title="partner.name"
                ><img
                  style="width: 100%; height: 150px;"
                  :src="partner.image"
                  :alt="partner.name"
                  class="partner"
              /></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    partners: {
      default: () => {
        return [];
      },
    },
  },
};
</script>

<style>
.partner {
  filter: grayscale(100%);
  transition: all 0.2s ease-in-out;
}
.partner:hover {
  filter: grayscale(0);
}
</style>