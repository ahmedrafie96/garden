<template>
  <div class="container-fluid px-xl-20 px-lg-14">
    <!-- subscribeSecBlock -->
    <section
      class="subscribeSecBlock bgCover col-12 pt-xl-24 pb-xl-12 pt-lg-20 pt-md-16 pt-10 pb-md-8 pb-5"
      style="background:#f5f5f5;"
    >
    				<!-- <v-img width="1170" style="height:465px;" src="@/main/images/b-bg.jpg"> -->


					
      <header class="col-12 mainHeader mb-sm-9 mb-6 text-center">
        <h1 class="headingIV playfair fwEblod mb-4">
          {{$t('Subscribe_Our_Newsletter')}}
        </h1>
        <span class="headerBorder d-block mb-md-5 mb-3"
          ><img
            src="@/main/images/hbdr.png"
            alt="Header Border"
            class="img-fluid img-bdr"
        /></span>
        <p class="mb-sm-6 mb-3 text-center">
          {{$t('subscribe_text')}}
        </p>
      </header>
      <form class="emailForm1 mx-auto overflow-hidden d-flex flex-wrap">
        <input
          type="email"
          class="form-control px-4 border-0"
          :placeholder="$t('email')"
        />
        <button
          type="submit"
          class="btn btnTheme btnShop fwEbold text-white py-3 px-4"
        >
          {{$t('subscribe_now')}} <i :class="`fas fa-arrow-${$vuetify.rtl?'left':'right'} m${$vuetify.rtl?'r':'l'}-2 float-${$vuetify.rtl?'left':'right'}`"></i>
        </button>
      </form>
    </section>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>