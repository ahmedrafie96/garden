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
            <v-autocomplete
              :items="countries"
              item-text="name"
              item-value="id"
              v-model="item.country_id"
            >
            </v-autocomplete>
          </v-col>
          <v-col cols="6">
            <v-text-field
              v-for="(translation, index) in item.translations.filter(
                (i) => i.field == 'name'
              )"
              v-model="translation.value"
              :label="$t('name')"
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
        </v-row>
        <v-row>
          <v-col cols="3">
            <v-file-input
              v-model="cover_image"
              :label="$t('cover_image')"
              hide-details
            ></v-file-input>
            <v-img v-if="cover_image" :src="get_url(cover_image)" width="300">
            </v-img>
            <!-- <v-img :src="get_url(image)" width="300"></v-img> -->
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                {{ $t("item_images") }}
              </v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="4" v-for="(image, index) in images">
                    <v-hover>
                      <template v-slot:default="{ hover }">
                        <v-img :src="get_url(image)" width="300">
                          <v-fade-transition>
                            <v-overlay v-if="hover" absolute color="#e4e4e4">
                              <v-btn
                                icon
                                dark
                                color="#222222"
                                size="64"
                                @click="images.splice(index, 1)"
                              >
                                <v-icon>mdi-minus</v-icon></v-btn
                              >
                            </v-overlay>
                          </v-fade-transition>
                        </v-img>
                      </template>
                    </v-hover>
                  </v-col>
                  <v-col cols="4">
                    <v-btn @click="$refs.inputUpload.click()" icon>
                      <v-icon> mdi-plus </v-icon>
                      <input
                        v-show="false"
                        ref="inputUpload"
                        type="file"
                        @change="handleFileUpload"
                        multiple
                      />
                      <!-- <v-img :src="get_url(image)" width="300"></v-img> -->
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="save(item)">
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
          ],
        };
      },
    },
  },
  data() {
    return {
      images: [],
      cover_image: null,
    };
  },
  mounted() {
    // this.$store.dispatch("type/index");
    this.$store.dispatch("locales/index");
    this.$store.dispatch("country/index");
  },
  methods: {
    ...mapActions("city", ["store"]),
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

    async save(item) {
      let gallery = await this.$store.dispatch("gallery/store", {
        name: this.item.name,
        cover_image: this.cover_image,
        is_file: true,
      });
      if (this.images.length > 0) {
        this.images.map((image) => {
          image = {
            file: image,
            gallery_id: gallery.id,
            is_file: true,
          };

          this.$store.dispatch("media/store", image);
        });
      }
      item.gallery_id = gallery.id;
      let item_data = await this.$store.dispatch("city/store", item);
    },
  },
  computed: {
    ...mapState({
      types: (state) => state.type.all,
      countries: (state) => state.country.all,
      locales: (state) => state.locales.all,
    }),
  },
};
</script>