<template>
  <main>
    <intro-banner-holder :title="$t('cart')" :sub_route="$t('cart')" />

    <div class="cartHolder container pt-xl-21 pb-xl-24 py-lg-20 py-md-16 py-10">
      <div class="row">
        <!-- table-responsive -->
        <div class="col-12 table-responsive mb-xl-22 mb-lg-20 mb-md-16 mb-10">
          <!-- cartTable -->
          <table style="text-align: left !important" class="table cartTable">
            <thead style="text-align: center">
              <tr>
                <th
                  style="text-align: start"
                  scope="col"
                  class="text-uppercase fwEbold border-top-0"
                >
                  {{ $t("product") }}
                </th>
                <th scope="col" class="text-uppercase fwEbold border-top-0">
                  {{ $t("price") }}
                </th>
                <th scope="col" class="text-uppercase fwEbold border-top-0">
                  {{ $t("quantity") }}
                </th>
                <th scope="col" class="text-uppercase fwEbold border-top-0">
                  {{ $t("location") }}
                </th>
                <th scope="col" class="text-uppercase fwEbold border-top-0">
                  {{ $t("accessories") }}
                </th>
                <th scope="col" class="text-uppercase fwEbold border-top-0">
                  {{ $t("total") }}
                </th>
                <th scope="col" class="text-uppercase fwEbold border-top-0">
                  #
                </th>
              </tr>
            </thead>
            <tbody style="text-align: center">
              <tr
                class="align-items-center"
                v-for="item in items"
                :key="item.id"
              >
                <td
                  class="
                    d-flex
                    align-items-center
                    border-top-0 border-bottom
                    px-0
                    py-6
                  "
                >
                  <div class="imgHolder">
                    <img
                      :src="item.image.url"
                      alt="image description"
                      class="img-fluid"
                    />
                  </div>
                  <span class="title pl-2"
                    ><router-link :to="`/product/${item.id}`">{{
                      item.name
                    }}</router-link></span
                  >
                </td>

                <td class="fwEbold border-top-0 border-bottom px-0 py-6">
                  {{ item.price }}$
                </td>

                <td class="border-top-0 border-bottom px-0 py-6">
                  <input
                    style="
                      border: black 2px solid;
                      text-align: center;
                      color: black;
                      font-weight: 700;
                    "
                    @input="
                      ($event) => {
                        item.quantity = parseInt($event.target.value);
                        updateQuantity(item);
                      }
                    "
                    type="number"
                    placeholder="1"
                    :value="item.quantity"
                  />
                </td>
                <!-- here u can shows cities -->
                <td>
                  <span v-if="item.city_id">
                    {{ cities.find((i) => i.id == item.city_id).name }}
                  </span>
                  <v-btn
                    v-if="item.locationable"
                    @click="
                      map_dialog = true;
                      locating_item = item;
                    "
                    icon
                  >
                    <v-icon> fas fa-map-marker-alt </v-icon>
                  </v-btn>
                </td>

                <td>
                  <span v-if="item.city_id">
                    {{ cities.find((i) => i.id == item.city_id).name }}
                  </span>
                  <v-btn
                    v-if="item.locationable"
                    @click="accessories_dialog = true"
                    dark
                    color="primary"                    
                  >
                  {{$t('choose')}}
                  </v-btn>
                </td>
                <!-- <td>
                  <v-switch
                    v-if="item.locationable"
                    v-model="item.location_type"
                    @change="change_location($event, item)"
                  >
                    {{ $t("public") }}
                  </v-switch>
                </td> -->
                <td class="fwEbold border-top-0 border-bottom px-0 py-6">
                  {{ item.price * item.quantity }}$
                </td>
                <td class="fwEbold border-top-0 border-bottom px-0 py-6">
                  <a
                    v-if="item.editable"
                    href="javascript:void(0);"
                    @click="removeItem(item)"
                    class="fas fa-times float-right"
                  ></a>
                </td>
              </tr>
            </tbody>
          </table>

          <accessories-picker
            :accessories="allItems"
            :open="accessories_dialog"
            @closed="accessories_dialog = false"
          />

          <city-picker
            :open="map_dialog"
            :cities="cities"
            v-model="selected_city_id"
            @closed="
              map_dialog = false;
              locating_item.city_id = selected_city_id;
              checkAndUpdate(locating_item);
            "
          />

          <!-- //for mobile -->
        </div>
      </div>
      <div class="row">
        <!-- <div class="col-12">
          <form action="javascript:void(0);" class="cartForm mb-5">
            <div class="form-group mb-0">
              <label for="note" class="fwEbold text-uppercase d-block mb-1"
                >add note</label
              >
              <textarea id="note" class="form-control"></textarea>
            </div>
          </form>
        </div> -->
        <div class="col-12 col-md-6">
          <form action="javascript:void(0);" class="couponForm mb-md-0 mb-5">
            <!-- <fieldset>
              <div
                class="mt-holder d-inline-block align-bottom mr-lg-5 mr-0 mb-lg-0 mb-2"
              >
                <label for="code" class="fwEbold text-uppercase d-block mb-1"
                  >promo code</label
                >
                <input type="text" id="code" class="form-control" />
              </div>
              <button
                type="submit"
                class="btn btnTheme btnCart fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4"
              >
                Apply
              </button>
            </fieldset> -->
          </form>
        </div>
        <div class="col-12 col-md-6">
          <v-card class="elevation-0">
            <v-card-title>
              {{ $t("summary") }}
            </v-card-title>
            <v-card-text>
              <div class="d-flex justify-content-between">
                <strong class="txt fwEbold text-uppercase mb-1"
                  >subtotal</strong
                >
                <strong class="price fwEbold text-uppercase mb-1"
                  >{{
                    items.reduce((c, n) => c + n.price * n.quantity, 0)
                  }}
                  $</strong
                >
              </div>
              <v-divider></v-divider>
              <div style="padding: 10px 5px; font-weight: bold">
                {{ $t("pay_with_your_card") }}
              </div>
              <!-- <stripe-element-card
                ref="elementRef"
                :pk="publishableKey"
                @token="tokenCreated"
              /> -->
              <v-text-field v-model="name"></v-text-field>
              <!-- <div id="card-element"></div> -->
            </v-card-text>
            <v-btn @click="submit" outlined rounded block dark color="primary">
              {{ $t("submit_order") }}
            </v-btn>
          </v-card>
        </div>
      </div>
    </div>
    <!-- <subscribe-section /> -->
  </main>
</template>

<script>
import { mapActions, mapState } from "vuex";
import MapDialog from "../../dashboard/component/MapDialog.vue";
import { StripeElementCard } from "@vue-stripe/vue-stripe";
console.log("TEST 123");

export default {
  components: { StripeElementCard, MapDialog },
  computed: {
    ...mapState({
      items: (state) => state.cart.items,
      cities: (state) => state.city.all,
      allItems: (state) => state.item.all,
    }),
  },
  mounted() {
    this.$store.dispatch("item/index");
    this.$store.dispatch("city/index");
    // let script = document.createElement("script");
    // script.src = "https://2pay-js.2checkout.com/v1/2pay.js";
    // document.head.appendChild(script);
    // script.onload = () => {
    //   let jsPaymentClient = new TwoPayClient("250916165507");
    //   // Create the component that will hold the card fields.
    //   let component = jsPaymentClient.components.create("card");
    //   // Mount the card fields component in the desired HTML tag. This is where the iframe will be located.
    //   component.mount("#card-element");
    //   this.component = component;
    //   window["pc"] = jsPaymentClient;
    // };
    // this.component = component;
    // };
    window.scrollTo(0,0);
  },
  methods: {
    ...mapActions("cart", [
      "removeItem",
      "updateQuantity",
      "addItem",
      "addAccessor",
    ]),
    ...mapActions("item", [
        "index"
    ]),
    submit() {
      // You will be redirected to Stripe's secure checkout page
      // this.$refs.elementRef.submit();
      const billingDetails = {
        name: this.name,
      };
      this.tokenCreated("mewo");
      // Call the generate method using the component as the first parameter
      // and the billing details as the second one
      // window.pc.tokens
      //   .generate(this.component, billingDetails)
      //   .then((response) => {
      //     this.tokenCreated(response.token);
      //   })
      //   .catch((error) => {
      //     console.error(error);
      //   });
    },
    async tokenCreated(token) {
      console.log(token);
      let order_data = {
        customer_id: this.$store.state.auth.user.user.id,
      };
      let order = await this.$store.dispatch("order/store", order_data);
      this.items.map((item) => {
        let purchase = {
          order_id: order.id,
          item_id: item.id,
          quantity: item.quantity,
          city_id: item.city_id,
          country_id: item.country_id,
        };
        if (item.location) purchase.location = item.location;
        this.$store.dispatch("order_purchase/store", purchase);
      });
      this.$store.dispatch("order_payment/store", {
        order_id: order.id,
        // card_token: token.id,
      });
    },
    checkAndUpdate(item) {
      if (item.location) {
        if (item.location.type == "public") {
          if (item.accessors)
            item.accessors.map((i) => {
              i.qty *= item.quantity;
              this.addAccessor(i);
            });
        } else {
          if (item.accessors)
            item.accessors.map((i) => {
              // console.log([i.accessor.id,this.items.findIndex(x=>x.id==i.accessor.id)]);
              this.removeItem(i.accessor);
            });
        }
      }
    },
    change_location(i, item) {
      if (i) {
        item.location.type = "public";
      } else {
        item.location.type = "private";
      }
      this.checkAndUpdate(item);
    },
  },
  data() {
    return {
      accessories_dialog: false,
      map_dialog: false,
      publishableKey:
        "pk_test_51HflfKI5KESslpeP8ALRKoW1aVwRS3DiyElyChJtRY0iFJqTJOG7n7Ajzjjcw5gOvMMWdtTQA7iJje6QOKBszpTE00p63JMcGz",
      loading: false,
      selected_city_id: null,
      locating_item: null,
      document: document,
      component: null,
      name: null,
      pc: null,
    };
  },
};
</script>

<style>
</style>