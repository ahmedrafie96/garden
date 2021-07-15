<template>
  <section
    class="featureSec container overflow-hidden pt-xl-12 pb-xl-29 pt-lg-10 pb-lg-14 pt-md-8 pb-md-10 py-5"
  >
    <div class="row">
      <!-- mainHeader -->
      <header class="col-12 mainHeader mb-5 text-center">
        <h1 class="headingIV playfair fwEblod mb-4">Related products</h1>
      </header>
    </div>
    <div class="row">
        <product :item="items[0]" class="col-12 col-sm-6 col-lg-3 position-relative featureCol mb-7" />
    </div>
  </section>
</template>

<script>
import { mapState } from 'vuex';
export default {
  computed:{
    ...mapState({
      items:(state)=>state.item.all
    })
  }
};
</script>

<style>
</style>