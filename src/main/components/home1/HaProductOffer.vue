<template>
  <div
    class="
      productOfferSec
      container
      overflow-hidden
      py-xl-12 py-lg-10 py-md-8 py-5
    "
  >

  <!-- 570 * 350 -->
    <div class="row">
      <div
      :key="index"
        v-for="(advertising , index) in advertisings"
        class="col-12 col-sm-6 mb-sm-0 mb-2"
      >
        <a :href="`https://${advertising.link}`">
          <img
          style="width:570px;height:350px;"
            :src="advertising.image"
            alt="image description"
            class="img-fluid"
          />
        </a>
      </div>
      <!-- <div class="col-12 col-sm-6">
       <img
            src="https://images.pexels.com/photos/1083386/pexels-photo-1083386.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
            alt="image description"
            class="img-fluid"
        />
      </div> -->
    </div>
  </div>
</template>

<script>
export default {
  props: ["advertisings"],
};
</script>

<style>
</style>