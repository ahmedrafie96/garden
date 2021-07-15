<template>
  <v-footer dark padless>
    <v-card color="green" class="flex" flat tile>
      <v-card-text class=" lighten-2 white--text text-center">
        <v-row justify="center">
          <v-col>
            <v-spacer></v-spacer>
            <span>{{ $t("email") }}: info@planttree.ps</span>
          </v-col>
          <v-col>
            <address class="m-0">
              {{ $t("address") }}: {{ $t("AlRasheed St.") }} - {{ $t("Gaza") }}
            </address></v-col
          >
          <v-col>
            <span
              >{{ $t("phone") }} :

              <span dir="ltr" style="direction: ltr !important">
                (+970) - 595 - 260 - 061
              </span>
            </span>
          </v-col>
        </v-row>
        <v-col>
          <v-btn
            v-for="icon in icons"
            :key="icon"
            class="mx-4 white--text"
            icon
          >
            <v-icon size="24px">{{ icon }}</v-icon>
          </v-btn>
        </v-col>
        <span class="green  py-2 black--text text-center">
          <strong> {{ new Date().getFullYear() }}</strong> —
          <strong>{{$t('plant_a_tree')}}</strong>
        </span>
      </v-card-text>
    </v-card>
  </v-footer>
</template>

<script>
export default {
  props: {
    items: {
      default: () => {
        return [];
      },
    },
  },
  data: () => ({
    icons: ["mdi-facebook", "mdi-twitter", "mdi-linkedin", "mdi-instagram"],
  }),
};
</script>

<style>
/*   <aside
    class="footerHolder overflow-hidden bg-lightGray pt-xl-23 pb-xl-8 pt-lg-10 pb-lg-8 pt-md-12 pb-md-8 pt-10"
  >
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-4">
          <h3 class="headingVI fwEbold text-uppercase mb-7">Contact Us</h3>
          <ul class="list-unstyled footerContactList mb-3">
            <li class="mb-3 d-flex flex-nowrap pr-xl-20 pr-0">
              <span class="icon icon-place mr-3"></span>
              <address class="fwEbold m-0">
                Address: London Oxford Street, 012 United Kingdom.
              </address>
            </li>
            <li class="mb-3 d-flex flex-nowrap">
              <span class="icon icon-phone mr-3"></span>
              <span class="leftAlign"
                >Phone :
                <a href="javascript:void(0);">(+032) 3456 7890</a></span
              >
            </li>
            <li class="email d-flex flex-nowrap">
              <span class="icon icon-email mr-2"></span>
              <span class="leftAlign"
                >Email:
                <a href="javascript:void(0);">Botanicalstore@gmail.com</a></span
              >
            </li>
          </ul>
          <ul class="list-unstyled followSocailNetwork d-flex flex-nowrap">
            <li class="fwEbold mr-xl-11 mr-md-8 mr-3">Follow us:</li>
            <li class="mr-xl-6 mr-md-5 mr-2">
              <a href="javascript:void(0);" class="fab fa-facebook-f"></a>
            </li>
            <li class="mr-xl-6 mr-md-5 mr-2">
              <a href="javascript:void(0);" class="fab fa-twitter"></a>
            </li>
            <li class="mr-xl-6 mr-md-5 mr-2">
              <a href="javascript:void(0);" class="fab fa-pinterest"></a>
            </li>
            <li class="mr-2">
              <a href="javascript:void(0);" class="fab fa-google-plus-g"></a>
            </li>
          </ul>
        </div>
        <!-- <div class="col-12 col-sm-6 col-lg-3 pl-xl-14 mb-lg-0 mb-4">
          <h3 class="headingVI fwEbold text-uppercase mb-6">Information</h3>
          <ul class="list-unstyled footerNavList">
            <li class="mb-1"><a href="javascript:void(0);">New Products</a></li>
            <li class="mb-2"><a href="javascript:void(0);">Top Sellers</a></li>
            <li class="mb-2"><a href="javascript:void(0);">Our Blog</a></li>
            <li class="mb-2">
              <a href="javascript:void(0);">About Our Shop</a>
            </li>
            <li><a href="javascript:void(0);">Privacy policy</a></li>
          </ul>
        </div> -->
        <!-- <div class="col-12 col-sm-6 col-lg-3 pl-xl-12 mb-lg-0 mb-4">
          <h3 class="headingVI fwEbold text-uppercase mb-7">My Account</h3>
          <ul class="list-unstyled footerNavList">
            <li class="mb-1"><a href="javascript:void(0);">My account</a></li>
            <li class="mb-2"><a href="javascript:void(0);">Discount</a></li>
            <li class="mb-2">
              <a href="javascript:void(0);">Orders history</a>
            </li>
            <li><a href="javascript:void(0);">Personal information</a></li>
          </ul>
        </div> -->
        <!-- <div class="col-12 col-sm-6 col-lg-2 pl-xl-18 mb-lg-0 mb-4">
          <h3 class="headingVI fwEbold text-uppercase mb-5">PRODUCTS</h3>
          <ul class="list-unstyled footerNavList">
            <li class="mb-2"><a href="javascript:void(0);">Delivery</a></li>
            <li class="mb-2"><a href="javascript:void(0);">Legal notice</a></li>
            <li class="mb-2"><a href="javascript:void(0);">Prices drop</a></li>
            <li class="mb-2"><a href="javascript:void(0);">New products</a></li>
            <li><a href="javascript:void(0);">Best sales</a></li>
            <li> 
              <v-menu offset-y >
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="primary" dark v-bind="attrs" v-on="on" text>
                    {{$t('language')}}
                  </v-btn>
                </template>
                <v-list>
                  <v-list-item v-for="(item, index) in items" :key="index">
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                  </v-list-item>
                </v-list>
              </v-menu>
            </li>
          </ul>
        </div> -->
      </div>
    </div>
  </aside> */
</style>
