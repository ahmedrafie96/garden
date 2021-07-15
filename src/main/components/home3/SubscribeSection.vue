<template>
  <div class="container mb-lg-24 mb-md-16 mb-10">
    <!-- subscribeSecBlock -->
    <section
      class="subscribeSecBlock bgCover col-12 pt-lg-24 pb-lg-12 pt-md-16 pb-md-8 py-10"
      style="background:#f5f5f5"
    >
      <header class="col-12 mainHeader mb-9 text-center">
        <h1 class="headingIV playfair fwEblod mb-4">
                 {{$t('Subscribe_Our_Newsletter')}}
        </h1>
        <span class="headerBorder d-block mb-5"
          ><img
            src="@/main/images/hbdr.png"
            alt="Header Border"
            class="img-fluid img-bdr"
        /></span>
        <p class="mb-6">
          Enter Your email address to join our mailing list and keep yourself
          update
        </p>
      </header>
      <form class="emailForm1 mx-auto overflow-hidden d-flex flex-wrap">
        <input
          type="email"
          class="form-control px-4 border-0"
          placeholder="Enter your mail..."
        />
        <button
          type="submit"
          class="btn btnTheme btnShop fwEbold text-white py-3 px-4 py-md-3 px-md-4"
        >
          Shop Now <i :class="`fas fa-arrow-${$vuetify.rtl?'left':'right'} m${$vuetify.rtl?'r':'l'}-2 float-${$vuetify.rtl?'left':'right'}`"></i>
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