<template>
  <div>

    <v-divider></v-divider>
    <section style="padding: 28px; ">
      <v-container>
              <v-row>
        <v-col cols="3" class="text-center">
          <h3 class="headingVIII fwEbold text-uppercase">
            {{ $t("search") }}
          </h3>
        </v-col>

        <v-col cols="3">
          <v-text-field
            dense
            append-icon="fas fa-signature"
            v-model="params.name"
            :label="$t('name')"
          >
          </v-text-field>
        </v-col>

        <v-col cols="3">
          <v-autocomplete
            dense
            :items="categories"
            item-text="name"
            item-value="id"
            v-model="params.categories"
            :label="$t('category')"
            multiple
            signature
            append-icon="fas fa-layer-group"
          ></v-autocomplete>
        </v-col>
        <v-col cols="3">
          <v-text-field
            append-icon="fas fa-dollar-sign "
            dense
            :label="$t('price')"
            v-model="params.price"
          >
          </v-text-field>
        </v-col>
      </v-row>
      </v-container>

    </section>

    <!-- showing items and special items-->
    <v-card  flat class="mt-8">
      <v-container>
        <v-row>
          <!-- 1) showing items -->
          <v-col  cols="9">
            <v-card flat>
              <v-container>
                <h3 class="headingVII fwEbold text-uppercase mb-5 text-center">
                  {{ $t("Available Items") }}
                </h3>
                <v-card-text>
                  <v-item-group>
                    <v-row>
                      <v-col
                        v-for="(item, index) in items"
                        :key="index"
                        cols="12"
                        md="4"
                      >
                        <v-item>
                          <product
                            @added_to_cart="addItem(item)"
                            :item="item"
                            :key="index"
                          />
                        </v-item>
                      </v-col>
                    </v-row>
                  </v-item-group>
                </v-card-text>
              </v-container>
              <pagination
                :meta="meta"
                @paginated="(v) => $store.dispatch('item/changeCurrentPage', v)"
                class="col-12 pt-3 mb-lg-0 mb-md-6 mb-3"
              />
            </v-card>
          </v-col>
          <!-- speciel items  -->
          <v-col cols="3">
            
            <v-card  flat>
              <v-list>
                <h3 class="headingVII fwEbold text-uppercase mb-5 text-center">
                  {{ $t("Speciel Items") }}
                </h3>
                <v-list-item v-for="(item, index) in items" :key="index">
                  <v-row
                    v-ripple="{ center: true }"
                    class="elevation-2"
                    style="margin-top: 20px; "
                  >
                    <v-col>
                      <v-img
                      style="border-radius:5em"
                        height="80"
                        width="80"
                        :src="item.image.url"
                      ></v-img>
                    </v-col>
                    <v-col class="text-capitalize" align-self="center"> {{ item.name }} <br>
                     {{ item.price }}$</v-col>
 
                  </v-row>
                </v-list-item>
              </v-list>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-card>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  data() {
    return {
      cart: [],
      params: {},
    };
  },
  mounted() {
    this.$store.dispatch("item/index");
    this.$store.dispatch("category/index");
  },
  methods: {
    ...mapActions("cart", ["addItem"]),
  },
  computed: {
    ...mapState({
      items: (state) => state.item.all,
      categories: (state) => state.category.all,
      meta: (state) => state.item.meta,
    }),
  },
  watch: {
    params: {
      handler(val) {
        // console.log("AAAAA");
        this.$store.dispatch("item/index", val);
      },
      deep: true,
    },
  },
};
</script>

<style>
</style>