<template>
  <main>
    <!-- introBannerHolder -->
    <section dir="ltr" class="introBannerHolder d-flex w-100 bgCover">
  <img v-if="this.$vuetify.breakpoint.width > 600 " width="400" style="height:250px;" 
      :src="require(`@/main/images/head2.png`)"
  
   alt="">
				<div  :class="this.$vuetify.breakpoint.width > 600 ? 'ml-20 container':'container'">
        <div class="row">
          <div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
            <h1 class="headingIV fwEbold playfair mb-4">{{$t('store')}}</h1>
            <ul class=" list-unstyled breadCrumbs d-flex justify-content-center">
              <li class="mr-2">
                <router-link to="/">{{$t('home')}}  </router-link>
                <!-- <a href="/">Home</a> -->
              </li>
              <li class="mr-2">/</li>
              <li class="mr-2">
                <router-link to="/store"> {{$t('store')}} </router-link>
                <!-- <a href="/store">Shop</a> -->
              </li>
              <li class="mr-2">/</li>
              <li class="active">{{ product.name }}</li>
            </ul>
          </div>
        </div>
      </div>
  <img v-if="this.$vuetify.breakpoint.width > 600 " width="400" style="height:250px;" 
  
        :src="require(`@/main/images/head1.png`)"
 
  alt="">
   
    </section>
    <!-- twoColumns -->
    <div
    dir="ltr"
      class="
        twoColumns
        container
        pt-xl-23
        pb-xl-20
        pt-lg-20
        pb-lg-20
        py-md-16 py-10
      "
    >
      <div class="row mb-6">
        <div class="col-12 col-lg-6 order-lg-1">
          <!-- productSliderImage -->
          <div class="productSliderImage mb-lg-0 mb-4">
            <div :key="photo">
              <img
                :src="product.gallery.cover_image.url"
                alt="image description"
                class="img-fluid w-100"
              />
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 order-lg-3">
          <!-- productTextHolder -->
          <div class="productTextHolder overflow-hidden">
            <h2 class="fwEbold mb-2">{{ product.name }}</h2>
            <ul :dir="$vuetify.rtl?'rtl':'ltr'" class="list-unstyled ratingList d-flex flex-nowrap mb-2">
              <li>
                <v-rating
                  dense
                  small
                  v-model="product.average_rank"
                  background-color="orange lighten-3"
                  color="orange"
                  large
                  hover
                ></v-rating>
              </li>

              <li >( {{ product.rank_count }} {{$t('reviews')}} )</li>
            </ul>
            <strong class="price d-block mb-5 text-green"
              >{{ product.price }} $</strong
            >
            <p class="mb-5">{{ product.brief }}</p>
            <ul class="list-unstyled productInfoDetail mb-5 overflow-hidden">
              <li class="mb-2">
                {{$t('code')}}: <span>{{ product.code }}</span>
              </li>
              <li v-if="product.height" class="mb-2">{{$t('height')}} : <span>{{product.height}} M</span></li>
              <li v-if="product.radius" class="mb-2">{{$t('radius')}} : <span>{{product.radius}} Inch</span></li>
            </ul>
            <div @click="addItem(product)" class="holder overflow-hidden d-flex flex-wrap mb-10">
              <input
                
                type="number"
                placeholder="1"
              />
              <a 
                href="javascript:void(0);"
                class="
                  btn
                  btnTheme
                  btnShop
                  fwEbold
                  text-white
                  md-round
                  py-3
                  px-4
                  py-md-3
                  px-md-4
                "
                >{{$t('add_to_cart')}} <i :class="`fas fa-arrow-${$vuetify.rtl?'left':'right'} m${$vuetify.rtl?'r':'l'}-2 float-${$vuetify.rtl?'left':'right'}`"></i
              ></a >
            </div>
            <ul
              class="list-unstyled socialNetwork d-flex flex-wrap mb-sm-11 mb-4"
              :dir="$vuetify.rtl?'rtl':'ltr'"
            >
              <li class="text-uppercase mr-5">{{$t('SHARE_THIS_PRODUCT')}}:</li>
              <li class="mr-4">
                <a href="javascript:void(0);" class="fab fa-facebook-f"></a>
              </li>
              <li class="mr-4">
                <a href="javascript:void(0);" class="fab fa-google-plus-g"></a>
              </li>
              <li class="mr-4">
                <a href="javascript:void(0);" class="fab fa-twitter"></a>
              </li>
              <li class="mr-4">
                <a href="javascript:void(0);" class="fab fa-pinterest-p"></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
				<div class="row">
					<div class="col-12">
						<!-- paggSlider -->
						<div class="paggSlider">
							<div  v-for="photo in product.gallery.media">
								<div class="imgBlock">
									<img width="170" style="height:190px;" :src="photo.url" alt="image description" class="img-fluid">
								</div>
							</div>
							<!-- <div>
								<div class="imgBlock">
									<img src="http://placehold.it/170x190" alt="image description" class="img-fluid">
								</div>

							</div> -->
							<!-- <div>
								<div class="imgBlock">
									<img src="http://placehold.it/170x190" alt="image description" class="img-fluid">
								</div>
							</div> -->
							<!-- <div>
								<div class="imgBlock">
									<img src="http://placehold.it/170x190" alt="image description" class="img-fluid">
								</div>
							</div>
							<div>
								<div class="imgBlock">
									<img src="http://placehold.it/170x190" alt="image description" class="img-fluid">
								</div>
							</div>
							<div>
								<div class="imgBlock">
									<img src="http://placehold.it/170x190" alt="image description" class="img-fluid">
								</div>
							</div>
							<div>
								<div class="imgBlock">
									<img src="http://placehold.it/170x190" alt="image description" class="img-fluid">
								</div>
							</div> -->


						</div>
					</div>
				</div>
    </div>
    <div dir="ltr" class="container">
      <div class="row">
        <div class="col-12">
          <!-- tabSetList -->
          <ul
            class="list-unstyled tabSetList d-flex justify-content-center mb-9"
          >
            <li class="mr-md-20 mr-sm-10 mr-2">
              <a href="#tab1-0" class="active playfair fwEbold pb-2"
                >{{$t('Description')}}</a
              >
            </li>
            <!-- <li>
								<a href="#tab2-0" class="playfair fwEbold pb-2">Reviews ( 2 )</a>
							</li> -->
          </ul>
          <!-- tab-content -->
          <div class="tab-content mb-xl-11 mb-lg-10 mb-md-8 mb-5">
            <div id="tab1-0" class="active" v-html="product.description" :dir="$vuetify.rtl?'rtl':'ltr'"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- featureSec -->
    <section
      class="
        featureSec
        container
        overflow-hidden
        pt-xl-12
        pb-xl-29
        pt-lg-10
        pb-lg-14
        pt-md-8
        pb-md-10
        py-5
      "
    >
      <div class="row">
        <!-- mainHeader -->
        <header class="col-12 mainHeader mb-5 text-center">
          <h1 class="headingIV playfair fwEblod mb-4">{{$t('Related_products')}}</h1>
        </header>
      </div>
      <div class="row">
        <!-- featureCol -->
      
        <div v-for="product in products" class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-7">
          <div class="border">
            <div class="imgHolder position-relative w-100 overflow-hidden">
              <img
              width="268"
              style="height:297px"
                :src="product.image.url"
                alt="image description"
                class="img-fluid w-100"
              />
              <ul
                class="
                  list-unstyled
                  postHoverLinskList
                  d-flex
                  justify-content-center
                  m-0
                "
              >
                <li class="mr-2 overflow-hidden">
                  <a href="javascript:void(0);" class="icon-heart d-block"></a>
                </li>
                <li  @click="addItem(product)" class="mr-2 overflow-hidden">
                  <a  href="javascript:void(0);" class="icon-cart d-block"></a>
                </li>
                <li class="mr-2 overflow-hidden">
                  <router-link :to="`product/${product.id}`" class="icon-eye d-block"></router-link >
                </li>
                <li class="overflow-hidden">
                  <a href="javascript:void(0);" class="icon-arrow d-block"></a>
                </li>
              </ul>
            </div>
            <div class="text-center py-5 px-4">
              <span class="title d-block mb-2"
                ><router-link  :to="`product/${product.id}`">{{product.name}}</router-link  ></span
              >
              <span class="price d-block fwEbold"
                > {{product.price}} $</span
              >
              <span
                class="
                  hotOffer
                  green
                  fwEbold
                  text-uppercase text-white
                  position-absolute
                  d-block
                "
                >Sale</span
              >
            </div>
          </div>
        </div>
        
        <!-- featureCol -->
        <!-- featureCol -->
        <!-- <div class="col-12 col-sm-6 col-lg-3 featureCol position-relative mb-7">
          <div class="border">
            <div class="imgHolder position-relative w-100 overflow-hidden">
              <img
                src="http://placehold.it/270x300"
                alt="image description"
                class="img-fluid w-100"
              />
              <ul
                class="
                  list-unstyled
                  postHoverLinskList
                  d-flex
                  justify-content-center
                  m-0
                "
              >
                <li class="mr-2 overflow-hidden">
                  <a href="javascript:void(0);" class="icon-heart d-block"></a>
                </li>
                <li class="mr-2 overflow-hidden">
                  <a href="javascript:void(0);" class="icon-cart d-block"></a>
                </li>
                <li class="mr-2 overflow-hidden">
                  <a href="javascript:void(0);" class="icon-eye d-block"></a>
                </li>
                <li class="overflow-hidden">
                  <a href="javascript:void(0);" class="icon-arrow d-block"></a>
                </li>
              </ul>
            </div>
            <div class="text-center py-5 px-4">
              <span class="title d-block mb-2"
                ><a href="shop-detail.html">Pellentesque aliquet</a></span
              >
              <span class="price d-block fwEbold">60.00 $</span>
              <span
                class="
                  hotOffer
                  fwEbold
                  text-uppercase text-white
                  position-absolute
                  d-block
                "
                >Hot</span
              >
            </div>
          </div>
        </div> -->
        <!-- featureCol -->
      </div>

    </section>
  </main>
  <!-- <main>
    
    <intro-banner-holder
      :title="$t('product_details')"
      :sub_route="$t('product')"
    />


      <v-container>

    <v-card flatyy>
      <v-container>
        
      <v-row>
      <v-col class="text-center" cols="6">
          <product-text-holder :item="product" />
      </v-col>
     <v-col class="text-center" cols="6">
         <product-slider :gallery="product.gallery" />
      </v-col>
      </v-row>
      <v-row>
  <product-tabs :product="product" />
      </v-row>
      </v-container>
    </v-card>
      </v-container>

  </main> -->
</template>

<script>
import { mapState, mapActions } from "vuex";
import ProductPageSlider from "../components/product/ProductPageSlider.vue";
import ProductSlider from "../components/product/ProductSlider.vue";
import RelatedProducts from "../components/product/RelatedProducts.vue";
export default {
  data: () => ({
    rating: null,
  }),
  methods: {
    ...mapActions("cart", ["addItem"]),
  },
  components: { ProductPageSlider, ProductSlider, RelatedProducts },
  mounted() {
    // jQuery(".paggSlider").slick({
    //   slidesToShow: 6,
    //   slidesToScroll: 1,
    //   asNavFor: ".productSliderImage",
    //   arrows: false,
    //   focusOnSelect: true,
    //   responsive: [
    //     {
    //       breakpoint: 1170,
    //       settings: {
    //         slidesToShow: 5,
    //       },
    //     },
    //     {
    //       breakpoint: 992,
    //       settings: {
    //         slidesToShow: 4,
    //       },
    //     },
    //     {
    //       breakpoint: 768,
    //       settings: {
    //         slidesToShow: 3,
    //       },
    //     },
    //     {
    //       breakpoint: 480,
    //       settings: {
    //         slidesToShow: 2,
    //       },
    //     },
    //   ],
    // });
    let id = this.$route.params.id;
    console.table(id);
    this.$store.dispatch("item/show", { id });
    this.$store.dispatch("item/index", { related_to:id });
    window.scrollTo(0,0);
  
  },
  computed: {
    ...mapState({
      product: (state) => state.item.one,
      products: (state) => state.item.all,
    }),
  },
  watch: {
    product() {
      setTimeout(() => {

        jQuery('.paggSlider').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.productSliderImage',
            arrows: false,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 1170,
                    settings: {
                        slidesToShow: 5
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2
                    }
                }
            ]
        });

        jQuery(".partnerSlider").slick({
          dots: false,
          speed: 800,
          infinite: true,
          slidesToShow: 6,
          slidesToScroll: 1,
          adaptiveHeight: true,
          autoplay: true,
          arrows: false,
          autoplaySpeed: 2000,
          responsive: [
            {
              breakpoint: 1170,
              settings: {
                slidesToShow: 5,
              },
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 4,
              },
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 2,
              },
            },
          ],
        });
      }, 100);
    },
  },
};
</script>

<style>
#tab1-0 p{
  padding:0 !important;
}
</style>