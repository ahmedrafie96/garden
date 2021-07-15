<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component heading="orders_form" />

    <base-material-card
      icon="mdi-clipboard-text"
      title="Item Form"
      class="px-5 py-3"
    >
      <v-form>
        <v-row>
          <v-col cols="3">
            <v-autocomplete
              :items="customers"
              :item-text="(v) => v.first_name + v.last_name"
              item-value="id"
              v-model="item.customer_id"
              :label="$t('customer')"
            />
          </v-col>
          <v-col cols="3">
            <v-autocomplete
              :items="taxes"
              item-text="name"
              @change="setTax($event, item)"
              :label="$t('tax')"
              return-object
            />
          </v-col>
          <v-col cols="3"> </v-col>
          <v-col cols="3">
            <v-card>
              <v-card-title>
                {{ $t("summary") }}
              </v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="6">
                    {{ $t("total") }}
                  </v-col>
                  <v-col cols="6">
                    {{ total }}
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    {{ $t("discount") }}
                  </v-col>
                  <v-col cols="6">
                    <v-text-field
                      v-model="item.total_discount"
                      value="0"
                      dense
                      single-line
                      shaped
                    />
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    {{ $t("tax") }}
                  </v-col>
                  <v-col cols="6">
                    {{
                      (tax_value =
                        (total - (item.total_discount || 0)) *
                        ((tax.percentage || 0) / 100))
                    }}
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    {{ $t("total_taxed") }}
                  </v-col>
                  <v-col cols="6">
                    {{ total - (item.total_discount || 0) + tax_value - 0 }}
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-card>
              <v-btn block @click="all.push({})" v-if="all.length == 0">
                <v-icon> mdi-plus </v-icon>
                {{ $t("click_here_to_add_items") }}
              </v-btn>
              <v-simple-table v-else>
                <thead>
                  <tr>
                    <th class="primary--text">
                      {{ $t("item") }}
                    </th>
                    <th class="primary--text">
                      {{ $t("quantity") }}
                    </th>
                    <th class="primary--text">
                      {{ $t("free_quantity") }}
                    </th>
                    <th class="primary--text">
                      {{ $t("price") }}
                    </th>
                    <th class="primary--text">
                      {{ $t("location") }}
                    </th>
                    <th>
                      <v-btn @click="all.push({})" icon>
                        <v-icon>fas fa-plus</v-icon>
                      </v-btn>
                    </th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="(one, index) in all">
                    <td>
                      <v-autocomplete
                        :items="items"
                        item-text="name"
                        return-object
                        @change="item_changed($event, one)"
                        single-line
                      />
                    </td>
                    <td>
                      <v-text-field v-model.number="one.quantity" single-line />
                    </td>
                    <td>
                      <v-text-field
                        v-model.number="one.free_quantity"
                        single-line
                      />
                    </td>
                    <td>
                      {{ (one.total = one.price * one.quantity || 0) }}
                    </td>
                    <td>
                      <v-btn
                        @click="map_dialog = true"
                        icon
                        v-if="one.parent_type_id == null"
                      >
                        <v-icon> mdi-location </v-icon>
                      </v-btn>
                      <map-dialog
                        :open="map_dialog"
                        v-model="one.location"
                        @closed="map_dialog = false"
                      />
                    </td>
                    <td>
                      <v-btn icon @click="all.splice(index, 1)">
                        <v-icon> mdi-close </v-icon>
                      </v-btn>
                    </td>
                  </tr>
                </tbody>
              </v-simple-table>
            </v-card>
          </v-col>
        </v-row>
        <v-row v-if="all.length > 0">
          <v-col cols="12">
            <v-btn dark color="primary" block @click="save">
              <v-icon> mdi-check </v-icon>
              {{ $t("save") }}
            </v-btn>
          </v-col>
        </v-row>
      </v-form>
    </base-material-card>
  </v-container>
</template>
<script>
import { mapActions, mapState } from "vuex";
import MapDialog from "../../../component/MapDialog.vue";
export default {
  props: {
    item: {
      type: Object,
      default: () => {
        return {};
      },
    },
  },
  components: {
    MapDialog,
  },
  data() {
    return {
      images: [],
      all: [],
      tax: {},
      map_dialog: false,
      location: {},
    };
  },
  mounted() {
    this.$store.dispatch("item/index");
    this.$store.dispatch("tax/index");
    this.$store.dispatch("customer/index");
  },
  methods: {
    async save() {
      let order = await this.$store.dispatch("order/store", this.item);
      this.all.map((purchase) => {
        purchase.order_id = order.id;
        this.$store.dispatch("purchase/store", purchase);
      });
    },
    item_changed(item, list_item) {
      list_item.price = item.price;
      list_item.item_id = item.id;
      list_item.parent_type_id = item.type.parent_id;
    },
    setTax(tax, item) {
      this.tax = tax;
      item.tax_id = tax.id;
    },
  },
  computed: {
    ...mapState({
      items: (state) => state.item.all,
      customers: (state) => state.customer.all,
      taxes: (state) => state.tax.all,
    }),
    total() {
      return this.all
        .filter((i) => i.item_id != null && i.quantity != null)
        .reduce((c, n) => c + n.total, 0);
    },
  },
};
</script>