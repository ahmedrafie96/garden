<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component heading="payments_form" />

    <base-material-card
      icon="mdi-clipboard-text"
      title="Item Form"
      class="px-5 py-3"
    >
      <v-form>
        <v-row>
          <v-col cols="3">
            <v-autocomplete
              :items="orders"
              item-text="id"
              item-value="id"
              v-model="item.order_id"
              :label="$t('order')"
            />
          </v-col>
          <v-col cols="3">
            <v-text-field :label="$t('amount')" v-model.number="item.amount" />
          </v-col>
        </v-row>
        <v-row v-if="item.amount && item.order_id">
          <v-col cols="12">
            <v-btn dark color="primary" block @click="store(item)">
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
export default {
  props: {
    item: {
      type: Object,
      default: () => {
        return {};
      },
    },
  },
  data() {
    return {
      images: [],
      all: [],
    };
  },
  mounted() {
    this.$store.dispatch("order/index");
    this.$store.dispatch("customer/index");
  },
  methods: {
    ...mapActions("payment", ["store"]),
    item_changed(item, list_item) {
      list_item.price = item.price;
      list_item.item_id = item.id;
    },
    setTax(tax, item) {
      this.tax = tax;
      item.tax_id = tax.id;
    },
  },
  computed: {
    ...mapState({
      customers: (state) => state.customer.all,
      orders: (state) => state.order.all,
    }),
    total() {
      return this.all
        .filter((i) => i.item_id != null && i.quantity != null)
        .reduce((c, n) => c + n.total, 0);
    },
  },
};
</script>