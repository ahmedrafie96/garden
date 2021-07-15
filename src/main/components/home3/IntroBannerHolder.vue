<template>
  <section dir="ltr" class="introBannerHolder d-flex w-100 bgCover">
    <img
      width="100%"
      height="100%"
      style="margin-right: 70px"
      :src="
        require(`@/main/images/bg${Math.floor(Math.random() * 5) + 1}.jpeg`)
      "
    />
    <div
      :class="this.$vuetify.breakpoint.width > 600 ? ' container' : 'container'"
    >
      <div class="row">
        <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
          <h1 style="color: white" class="headingIV fwEbold playfair mb-4">
            {{ $t(title) }}
          </h1>
          <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
            <li class="mr-2">
              <router-link to="/">{{ $t("home") }}</router-link>
            </li>
            <li class="mr-2">/</li>
            <li class="active">{{ $t(sub_route) }}</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["title", "sub_route", "slider", "image"],
};
</script>

<style scoped>
</style>