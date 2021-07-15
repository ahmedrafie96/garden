<template>
  <section
    class="teamSec pt-xl-12 pb-xl-21 pt-lg-10 pb-lg-20 pt-md-8 pb-md-16 pt-0 pb-4"
    v-if="team.length > 0"
  >
    <div class="container">
      <div class="row">
        <header class="col-12 mainHeader mb-9 text-center">
          <h1 class="headingIV playfair fwEblod mb-4">
            {{ $t("meet_our_team") }}
          </h1>
          <span class="headerBorder d-block mb-5"
            ><img
              src="images/hbdr.png"
              alt="Header Border"
              class="img-fluid img-bdr"
          /></span>
        </header>
      </div>
      <div class="row">
        <div
          class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-6"
          v-for="member in team"
        >
          <article class="teamBlock overflow-hidden">
            <span class="imgWrap position-relative d-block w-100 mb-4">
              <img
                :src="member.image"
                class="img-fluid"
                alt="image description"
              />
              <ul
                class="list-unstyled position-absolute mb-0 d-flex justify-content-center socialNetworks"
              >
                <li>
                  <a :href="member.facebook" class="fab fa-facebook-f"> </a>
                </li>
                <li>
                  <a :href="member.twitter" class="fab fa-twitter"></a>
                </li>
                <li>
                  <a :href="member.instagram" class="fab fa-instagram"></a>
                </li>
              </ul>
            </span>
            <div class="textDetail w-100 text-center">
              <h3>
                <strong class="text-uppercase d-block fwEbold name mb-2"
                  ><a href="javascript:void(0);">{{ member.name }}</a></strong
                >
                <strong class="text-capitalize d-block desination">{{
                  member.title
                }}</strong>
              </h3>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    team: {
      default: () => {
        return [];
      },
    },
  },
};
</script>

<style>
</style>