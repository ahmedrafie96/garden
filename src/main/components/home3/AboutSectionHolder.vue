<template>
  <section
    v-if="content.title"
    class="abtSecHolder container pt-xl-24 pb-xl-12 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 pt-10 pb-5"
  >
    <div class="row">
      <div class="col-12 col-lg-6 pt-xl-12 pt-lg-8">
        <h2 class="playfair fwEbold position-relative mb-7 pb-5">
          <strong class="d-block">{{ content.title }}</strong>
        </h2>
        <p class="pr-xl-16 pr-lg-10 mb-lg-0 mb-6" v-html="content.text">
        </p>
      </div>
      <div class="col-12 col-lg-6">
        <img :src="content.image" alt="image description" class="img-fluid" />
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    content: {
      default: () => {
        return {};
      },
    },
  },
};
</script>

<style>
</style>