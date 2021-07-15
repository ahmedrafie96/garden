<template>
  <main>
    <!-- introBannerHolder -->
    <!-- <section   class="introBannerHolder d-flex w-100 bgCover" >
			<img width="400" style="height:250px;" src="@/main/images/logo4.png" alt="">
				<div class="ml-20 container">
					<div class="row">
						<div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
						<h1 class="headingIV fwEbold playfair mb-4">About Us</h1>
							<ul class=" mr-9 list-unstyled breadCrumbs d-flex justify-content-center">
								<li class="mr-2"><router-link to="/">Home</router-link ></li>
								<li class="mr-2">/</li>
								<li class="active">About</li>
							</ul>
						</div>
					</div>
				</div>
				<img width="400" style="height:250px;" src="@/main/images/logo5.png" alt="">
			</section> -->
      <intro-banner-holder :title="$t('contact')" :sub_route="$t('contact')" />

    <div
      class="
        contactSec
        container
        pt-xl-24
        pb-xl-23
        py-lg-20
        pt-md-16
        pb-md-10
        pt-10
        pb-0
      "
    >
      <div class="row">
        <div class="col-12">
          <ul
            class="
              list-unstyled
              contactListHolder
              mb-0
              d-flex
              flex-wrap
              text-center
            "
          >
            <li class="mb-lg-0 mb-6 text-center">
              <span class="icon d-block mx-auto bg-lightGray py-4 mb-4"
                ><i class="fas fa-map-marker-alt"></i
              ></span>
              <strong class="title text-uppercase playfair mb-5 d-block"
                >address</strong
              >
              <address class="mb-0">
                Al-Rashed-Street ، Al-Forqan-Crossroads<span class="d-block">
                  Gaza - PS</span
                >
              </address>
            </li>
            <li class="mb-lg-0 mb-6 text-center">
              <span
                class="icon d-block mx-auto bg-lightGray py-4 mb-3 text-center"
                ><i class="fas fa-headphones"></i
              ></span>
              <strong class="title text-uppercase playfair mb-5 d-block"
                >phone</strong
              >
              <a href="tel:+970595260061" class="d-block text-center" dir="ltr"
                >+970595260061</a
              >
            </li>
            <li class="mb-lg-0 mb-6 text-center">
              <span
                class="icon d-block mx-auto bg-lightGray py-5 mb-3 text-center"
                ><i class="fas fa-envelope"></i
              ></span>
              <strong class="title text-uppercase playfair mb-5 d-block"
                >email</strong
              >
              <a href="mailto:info@planttree.ps" class="d-block text-center"
                >info@planttree.ps</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- mapHolder -->
    <div class="mapHolder">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13605.25005344737!2d34.4255604!3d31.5155756!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1c82566812d506ca!2z2YbYp9iv2Yog2KfZhNiv2YjZhNmB2YrZhg!5e0!3m2!1sar!2s!4v1625506777814!5m2!1sar!2s"
        width="600"
        height="450"
        style="border: 0"
        allowfullscreen=""
        loading="lazy"
      ></iframe>
    </div>
    <section
      class="
        contactSecBlock
        container
        pt-xl-23
        pb-xl-24
        pt-lg-20
        pb-lg-10
        pt-md-16
        pb-md-8
        py-10
      "
    >
      <div class="row">
        <header class="col-12 mainHeader mb-10 text-center">
          <h1 class="headingIV playfair fwEblod mb-7">
            {{ $t("get_in_touch") }}
          </h1>
          <!-- <p>
			  {{$t('')}}
<br class="d-block" />
            aliquam erat volutpatcommodo consequat.
          </p> -->
        </header>
      </div>
      <div class="row">
        <div class="col-12">
          <form class="contactForm">
            <div class="d-flex flex-wrap row1 mb-md-1">
              <div class="form-group coll mb-5">
                <input
                  type="text"
                  id="name"
                  class="form-control"
                  name="name"
                  :placeholder="$t('name') + '*'"
                />
              </div>
              <div class="form-group coll mb-5">
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="Email"
                  :placeholder="$t('email') + '*'"
                />
              </div>
              <div class="form-group coll mb-5">
                <input
                  type="tel"
                  class="form-control"
                  id="tel"
                  name="tel"
                  :placeholder="$t('phone') + '*'"
                />
              </div>
            </div>
            <div class="form-group w-100 mb-6">
              <textarea
                class="form-control"
                :placeholder="$t('message') + '*'"
              ></textarea>
            </div>
            <div class="text-center">
              <button
                type="submit"
                class="
                  btn
                  btnTheme
                  btnShop
                  md-round
                  fwEbold
                  text-white
                  py-3
                  px-4
                  py-md-3
                  px-md-4
                "
              >
                {{ $t("send_message") }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- footerHolder -->
  </main>
  <!-- <main>
      <contact-section />
      <map-holder />
      
  </main> -->
</template>

<script>
export default {
  mounted(){
    window.scrollTo(0,0);
  }
};
</script>

<style scoped>

</style>