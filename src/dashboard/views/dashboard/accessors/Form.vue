<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component :heading="$t('items_form')" />

    <base-material-card
      icon="mdi-clipboard-text"
      title="Item Form"
      class="px-5 py-3"
    >
      <v-form>
        <v-row>
          <v-col>
            <v-autocomplete
              dense
              :items="categories"
              item-text="name"
              item-value="id"
              v-model="item.categories"
              multiple
              :label="$t('category')"
            />
          </v-col>
          <!-- <v-col >
            <v-autocomplete
              dense
              v-model="item.item_id"
              :items="items"
              item-text="name"
              item-value="id"
              :label="$t('item')"
            >
            </v-autocomplete>
          </v-col> -->
          <v-col >
            <v-autocomplete
              dense
              v-model="item.accessor_item_id"
              :items="items"
              item-text="name"
              item-value="id"
              :label="$t('accessor')"
            >
            </v-autocomplete>
          </v-col>
          <v-col >
            <v-text-field dense v-model="item.qty" :label="$t('quantity')"  />
          </v-col>
          <v-col  cols="4" >
            <v-radio-group row dir="ltr" v-model="item.mandatory" :label="$t('Mandatory?')">
              <v-radio 
              :label="$t('yas')"
              :value="true"
              >
              </v-radio>
              <v-radio 
              :label="$t('no')"
              :value="false"
              >
              </v-radio>
            </v-radio-group>
          </v-col>

        </v-row>
        <v-row>
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
      default: () => {
        return {};
      },
    },
  },
  mounted() {
    this.$store.dispatch("item/index");
    this.$store.dispatch("category/index");
  },
  methods: {
    ...mapActions("accessor", ["store"]),
  },
  computed: {
    ...mapState({
      items: (state) => state.item.all,
      categories: (state) => state.category.all,
    }),
  },
};
</script>