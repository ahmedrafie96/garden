<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component heading="categories_form" />

    <base-material-card
      icon="mdi-clipboard-text"
      title="Item Form"
      class="px-5 py-3"
    >
      <v-form>
        <v-row>
          <v-col cols="6">
            <v-text-field
              v-for="(translation, index) in item.translations.filter(
                (i) => i.field == 'name'
              )"
              v-model="translation.value"
              :label="$t('name')"
              :key="index"
            >
              <template v-slot:prepend>
                <v-autocomplete
                  dense
                  v-model="translation.locale"
                  :items="locales"
                  item-text="locale.native_name"
                  item-value="locale.iso_639"
                >
                </v-autocomplete>
              </template>
              <template v-slot:append-outer>
                <v-btn
                  v-if="index > 0"
                  icon
                  @click="
                    item.translations.splice(
                      item.translations.findIndex(
                        (i) =>
                          i.field == 'name' && i.locale == translation.locale
                      ),
                      1
                    )
                  "
                >
                  <v-icon> fas fa-times </v-icon>
                </v-btn>
                <v-btn @click="item.translations.push({ field: 'name' })" icon>
                  <v-icon> fas fa-plus </v-icon>
                </v-btn>
              </template>
            </v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
            :key="index"
              v-for="(translation,index) in item.translations.filter(
                (i) => i.field == 'description'
              )"
              v-model="translation.value"
              :label="$t('discreption')"
            >
              <template v-slot:prepend>
                <v-autocomplete
                  dense
                  v-model="translation.locale"
                  :items="locales"
                  item-text="locale.native_name"
                  item-value="locale.iso_639"
                >
                </v-autocomplete>
              </template>
              <template v-slot:append-outer>
                <v-btn
                  icon
                  v-if="index > 0"
                  @click="
                    item.translations.splice(
                      item.translations.findIndex(
                        (i) =>
                          i.field == 'description' &&
                          i.locale == translation.locale
                      ),
                      1
                    )
                  "
                >
                  <v-icon> fas fa-times </v-icon>
                </v-btn>
                <v-btn
                  @click="item.translations.push({ field: 'description' })"
                  icon
                >
                  <v-icon> fas fa-plus </v-icon>
                </v-btn>
              </template>
            </v-text-field>
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
      type: Object,
      translations: Array,
      default: () => {
        return {
          translations: [
            {
              locale: "ar",
              field: "name",
            },
            {
              locale: "ar",
              field: "description",
            },
          ],
        };
      },
    },
  },
  data() {
    return {
      images: [],
    };
  },
  mounted() {
    // this.$store.dispatch("type/index");
    this.$store.dispatch("locales/index");
  },
  methods: {
    ...mapActions("category", ["store"]),
    get_url(image) {
      return URL.createObjectURL(image);
    },
    
    handleFileUpload(e) {
      console.log(e);
      let files = e.target.files;
      for (var i = 0; i < files.length; i++) {
        this.images.push(files[i]);
      }
      // for( let file in e.target.files)
      // this.images.concat(e.target.files);
    },
  },
  computed: {
    ...mapState({
      types: (state) => state.type.all,
      categories: (state) => state.category.all,
      locales: (state) => state.locales.all,
    }),
  },
};
</script>