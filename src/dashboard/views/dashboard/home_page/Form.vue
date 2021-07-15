<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component :heading="$t('Items_Form')" />

    <!-- {{ item.translation.locale }} -->
    <base-material-card
      icon="mdi-clipboard-text"
      :title="$t('Item Form')"
      class="px-5 py-3"
    >
      <v-form>
        <v-row>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                <v-row>
                  <v-col cols="10">
                    {{ $t("slider") }}
                  </v-col>
                  <v-col cols="2">
                    <v-btn
                      icon
                      @click="
                        slider.push({
                          image: null,
                          translation: [{ locale: '' }],
                        })
                      "
                    >
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-title>

              <v-card-text v-for="(item, i) in slider" :key="i">
                <v-card>
                  <v-card-text>
                    <v-row>
                      <!-- first col image -->
                      <v-col cols="6">
                        <v-file-input
                          v-model="item.image"
                          :label="$t('image')"
                          hide-details
                          v-if="!item.image"
                        ></v-file-input>
                        <v-text-field
                          clearable
                          v-model="item.image"
                          v-if="item.image"
                        ></v-text-field>
                        <v-img
                          v-if="item.image"
                          :src="get_url(item.image)"
                          width="300"
                        >
                        </v-img>
                      </v-col>
                      <!-- second col title and text aria -->
                      <v-col cols="5"> </v-col>

                      <v-col cols="1">
                        <!-- <v-btn icon @click="slider.push({})">
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn> -->
                        <v-btn icon @click="slider.splice(i, 1)">
                          <v-icon> fas fa-times </v-icon>
                        </v-btn>
                      </v-col>
                    </v-row>
                    <!--second row for text editing  -->

                    <v-row v-for="(translation, j) in item.translation">
                      <v-col cols="2">
                        <v-autocomplete
                          dense
                          v-model="translation.locale"
                          :items="locales"
                          item-text="locale.native_name"
                          item-value="locale.iso_639"
                          @change="chec"
                        >
                        </v-autocomplete>
                      </v-col>

                      <v-col>
                        <v-text-field
                          v-model="translation.title"
                          label="Title Text"
                        >
                        </v-text-field>
                        <v-text-field
                          v-model="translation.heading"
                          label="Heading Text"
                        >
                        </v-text-field>
                        <v-text-field
                          v-model="translation.description"
                          label="Description Text"
                        >
                        </v-text-field>
                      </v-col>
                      <v-col>
                        <v-btn
                          icon
                          fab
                          @click="
                            slider[i].translation.push({
                              locale: 'ar',
                              value: '',
                            })
                          "
                        >
                          <v-icon> fas fa-plus </v-icon>
                        </v-btn>
                        <v-btn
                          icon
                          fab
                          @click="slider[i].translation.splice(j, 1)"
                        >
                          <v-icon> fas fa-times </v-icon>
                        </v-btn>
                      </v-col>
                      <!-- <v-textarea
                    v-model="item.text"
                    :label="$t('text')"
                  ></v-textarea> -->
                    </v-row>
                  </v-card-text>
                </v-card>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="saveSlider">
              <v-icon> mdi-check </v-icon>
              {{ $t("save") }}
            </v-btn>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                <v-row>
                  <v-col cols="10">
                    {{ $t("featured_items") }}
                  </v-col>
                </v-row>
              </v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="4">
                    <v-autocomplete
                      :items="items"
                      item-text="name"
                      item-value="id"
                      v-model="featured_items"
                      multiple
                      chips
                    ></v-autocomplete>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="saveItems">
              <v-icon> mdi-check </v-icon>
              {{ $t("save") }}
            </v-btn>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                <v-row>
                  <v-col cols="10">
                    {{ $t("Why_Choose_Us") }}
                  </v-col>
                  <v-col v-if="!why_choose_us">
                    <v-btn
                      icon
                      @click="
                        why_choose_us.push({
                          image: null,
                          translation: [
                            {
                              locale: 'ar',
                              title: null,
                              text: null,
                            },
                          ],

                          items: [
                            {
                              image: null,
                              translation: [
                                {
                                  locale: 'ar',
                                  title: null,
                                  text: null,
                                },
                              ],
                            },
                          ],
                        })
                      "
                    >
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-title>
              <v-card-text v-for="choose in why_choose_us">
                <v-row>
                  <v-col cols="3">
                    <v-file-input
                      dense
                      v-model="choose.image"
                      :label="$t('image')"
                      hide-details
                      v-if="!choose.image"
                    ></v-file-input>
                    <v-text-field
                      clearable
                      v-model="choose.image"
                      v-if="choose.image"
                    ></v-text-field>
                    <v-img
                      v-if="choose.image"
                      :src="get_url(choose.image)"
                      width="300"
                    >
                    </v-img>
                  </v-col>
                </v-row>

                <v-row v-for="translation in choose.translation">
                  <v-col>
                    <v-autocomplete
                      dense
                      v-model="translation.locale"
                      label="Choose language"
                      :items="locales"
                      item-text="locale.native_name"
                      item-value="locale.iso_639"
                    >
                    </v-autocomplete>
                  </v-col>
                  <v-col>
                    <v-text-field
                      clearable
                      dense
                      v-model="translation.title"
                      label="Main Title"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col>
                    <v-text-field
                      clearable
                      dense
                      v-model="translation.text"
                      label="Main Text"
                    >
                    </v-text-field>
                  </v-col>

                  <v-col>
                    <v-btn
                      icon
                      @click="choose.translation.push({ locale: 'ar' })"
                    >
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>

                <v-row v-for="item in choose.items">
                  <v-col cols="1">
                    <v-btn
                      icon
                      @click="
                        choose.items.push({
                          image: null,
                          translation: [
                            {
                              locale: 'ar',
                              title: null,
                              text: null,
                            },
                          ],
                        })
                      "
                    >
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                  </v-col>
                  <v-col cols="3">
                    <v-file-input
                      dense
                      v-model="item.image"
                      :label="$t('image')"
                      hide-details
                      v-if="!item.image"
                    ></v-file-input>
                    <v-text-field
                      clearable
                      v-model="item.image"
                      v-if="item.image"
                    ></v-text-field>
                    <v-img
                      v-if="item.image"
                      :src="get_url(item.image)"
                      width="300"
                    >
                    </v-img>
                  </v-col>
                  <v-col>
                    <v-row v-for="(translation, w) in item.translation">
                      <v-col>
                        <v-autocomplete
                          dense
                          v-model="translation.locale"
                          label="Choose language"
                          :items="locales"
                          item-text="locale.native_name"
                          item-value="locale.iso_639"
                        >
                        </v-autocomplete>
                      </v-col>
                      <v-col>
                        <v-text-field
                          clearable
                          dense
                          v-model="translation.title"
                          label="Item Title"
                        >
                        </v-text-field>
                      </v-col>
                      <v-col>
                        <v-text-field
                          dense
                          v-model="translation.text"
                          label="Item Title"
                          clearable
                        >
                        </v-text-field>
                      </v-col>
                      <v-col>
                        <v-btn
                          icon
                          @click="item.translation.push({ locale: 'ar' })"
                        >
                          <v-icon> fas fa-plus </v-icon>
                        </v-btn>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="saveWhyChooseUs">
              <v-icon> mdi-check </v-icon>
              {{ $t("save") }}
            </v-btn>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                <v-row>
                  <v-col cols="10">
                    {{ $t("featured_posts") }}
                  </v-col>
                </v-row>
              </v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="4">
                    <v-autocomplete
                      :items="posts"
                      item-text="title"
                      item-value="id"
                      v-model="featured_posts"
                      multiple
                      chips
                    ></v-autocomplete>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="savePosts">
              <v-icon> mdi-check </v-icon>
              {{ $t("save") }}
            </v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                <v-row>
                  <v-col cols="10">
                    {{ $t("clients_quotes") }}
                  </v-col>
                  <v-col cols="2">
                    <v-btn icon @click="clients.push({})">
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-title>
              <v-card-text>
                <v-row v-for="(item, i) in clients" :key="i">
                  <v-col cols="4">
                    <v-file-input
                      v-model="item.image"
                      :label="$t('image')"
                      hide-details
                      v-if="!item.image"
                    ></v-file-input>
                    <v-img
                      v-if="item.image"
                      :src="get_url(item.image)"
                      width="300"
                    >
                    </v-img>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field v-model="item.name" :label="$t('name')">
                    </v-text-field>
                    <v-text-field v-model="item.title" :label="$t('title')" />
                    <v-textarea
                      v-model="item.text"
                      :label="$t('text')"
                    ></v-textarea>
                  </v-col>
                  <v-col cols="4">
                    <v-btn icon @click="clients.push({})">
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                    <v-btn icon @click="clients.splice(i, 1)">
                      <v-icon> fas fa-times </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="saveClients">
              <v-icon> mdi-check </v-icon>
              {{ $t("save") }}
            </v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                <v-row>
                  <v-col cols="10">
                    {{ $t("partners") }}
                  </v-col>
                  <v-col cols="2">
                    <v-btn icon @click="partners.push({})">
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-title>
              <v-card-text>
                <v-row v-for="(item, i) in partners" :key="i">
                  <v-col cols="4">
                    <v-file-input
                      v-model="item.image"
                      :label="$t('image')"
                      hide-details
                      v-if="!item.image"
                    ></v-file-input>
                    <v-img
                      v-if="item.image"
                      :src="get_url(item.image)"
                      width="300"
                    >
                    </v-img>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field v-model="item.name" :label="$t('name')">
                    </v-text-field>
                    <v-text-field v-model="item.link" :label="$t('link')">
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-btn icon @click="partners.push({})">
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                    <v-btn icon @click="partners.splice(i, 1)">
                      <v-icon> fas fa-times </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="savePartners">
              <v-icon> mdi-check </v-icon>
              {{ $t("save") }}
            </v-btn>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                <v-row>
                  <v-col cols="10">
                    {{ $t("Advertisings") }}
                  </v-col>
                  <v-col cols="2">
                    <v-btn icon @click="advertisings.push({})">
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-title>
              <v-card-text>
                <v-row v-for="(item, i) in advertisings" :key="i">
                  <v-col cols="4">
                    <v-file-input
                      v-model="item.image"
                      :label="$t('image')"
                      hide-details
                      v-if="!item.image"
                    ></v-file-input>

                    <v-img
                      v-if="item.image"
                      :src="get_url(item.image)"
                      width="300"
                    >
                    </v-img>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      v-model="item.name"
                      :label="`${$t('name')}  As www.google.com`"
                    >
                    </v-text-field>
                    <v-text-field v-model="item.link" :label="$t('link')">
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <!-- <v-btn icon @click="advertisings.push({})">
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn> -->
                    <v-btn icon @click="advertisings.splice(i, 1)">
                      <v-icon> fas fa-times </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="saveAdvertisings">
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { mapActions, mapState } from "vuex";
import UploadAdapter from "../../../plugins/uploadAdapter";
function UploadAdapterPlugin(editor) {
  editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
    return new UploadAdapter(loader);
  };
}
export default {
  data() {
    return {
      slider: [],
      featured_items: [],
      featured_posts: [],
      discover_posts: [],
      advertisings: [],
      why_choose_us: [],
      clients: [],
      partners: [],
      editor: ClassicEditor,
      editorConfig: {
        toolbar: {
          items: [
            "heading",
            "|",
            "bold",
            "italic",
            "fontColor",
            "fontBackgroundColor",
            "link",
            "bulletedList",
            "numberedList",
            "|",
            "outdent",
            "indent",
            "alignment",
            "|",
            "imageUpload",
            "blockQuote",
            "insertTable",
            "mediaEmbed",
            "undo",
            "redo",
          ],
        },
        // language: "en",
        image: {
          toolbar: [
            "imageTextAlternative",
            "imageStyle:full",
            "imageStyle:side",
          ],
        },
        table: {
          contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"],
        },
        extraPlugins: [UploadAdapterPlugin],
      },
    };
  },
  mounted() {
    this.$store.dispatch("item/index");
    this.$store.dispatch("post/index");
    this.$store.dispatch("setting/index");
    this.$store.dispatch("locales/index");
  },
  methods: {
    ...mapActions("accessor", ["store"]),
    get_url(image) {
      var binaryData = [];
      binaryData.push(image);
      return typeof image != "string"
        ? window.URL.createObjectURL(
            new Blob(binaryData, { type: "application/zip" })
          )
        : image;
    },

    // get_url(image) {
    //   return typeof image != "string" ? URL.createObjectURL(image) : image;
    // },
    handleFileUpload(e) {
      console.log(e);
      let files = e.target.files;
      for (var i = 0; i < files.length; i++) {
        this.images.push(files[i]);
      }
      // for( let file in e.target.files)
      // this.images.concat(e.target.files);
    },
    async image_upload(file) {
      if (typeof file == "string")
        return {
          url: file,
        };
      return await this.$store.dispatch("gallery_media/store", {
        file,
        is_file: true,
        gallery_id: 1,
      });
    },
    async saveItems() {
      this.$store.dispatch("setting/store", {
        key: "featured_items",
        value: JSON.stringify(this.featured_items),
      });
    },
    async savePosts() {
      this.$store.dispatch("setting/store", {
        key: "featured_posts",
        value: JSON.stringify(this.featured_posts),
      });
    },

    async saveWhyChooseUs() {
      if (typeof this.why_choose_us[0].image != "string") {
        let image = await this.image_upload(this.why_choose_us[0].image);
        this.why_choose_us[0].image = image.url;
      }

      if (this.why_choose_us[0].items.lenght > 0) {
        this.why_choose_us[0].items.map((image) => {
          if (image.id) {
            this.$store.dispatch("gallery_media/delete", { image });
          }
        });
      }
      for (let i = 0; i < this.why_choose_us[0].items.length; i++) {
        const item = this.why_choose_us[0].items[i];
        if (typeof item.image != "string") {
          let image = await this.image_upload(item.image);
          this.why_choose_us[0].items[i].image = image.url;
        }
      }

      this.$store.dispatch("setting/store", {
        key: "WhyChooseUs",
        value: JSON.stringify(this.why_choose_us),
      });
    },

    async saveClients() {
      for (let i in this.clients) {
        if (typeof this.clients[i].image != "string") {
          let image = await this.image_upload(this.clients[i].image);
          this.clients[i].image = image.url;
        }
      }
      this.$store.dispatch("setting/store", {
        key: "clients",
        value: JSON.stringify(this.clients),
      });
    },
    async savePartners() {
      for (let i in this.partners) {
        let image = await this.image_upload(this.partners[i].image);
        this.partners[i].image = image.url;
      }
      this.$store.dispatch("setting/store", {
        key: "partners",
        value: JSON.stringify(this.partners),
      });
    },

    async saveAdvertisings() {
      for (let i in this.advertisings) {
        let image = await this.image_upload(this.advertisings[i].image);
        this.advertisings[i].image = image.url;
      }
      this.$store.dispatch("setting/store", {
        key: "advertisings",
        value: JSON.stringify(this.advertisings),
      });
    },

    // async save(item) {
    //   let gallery_id=item.gallery_id;
    //   if (item.gallery_id) {
    //     if (typeof this.cover_image.url != "string") {
    //       this.$store.dispatch("gallery_cover/store", {
    //         gallery_id: item.gallery_id,
    //         cover_image: this.cover_image.url,
    //         is_file: true,
    //         gallery_id: item.gallery_id,
    //       });
    //     }
    //   } else {
    //     let gallery = await this.$store.dispatch("gallery/store", {
    //       name: this.item.name,
    //       cover_image: this.cover_image.url,
    //       is_file: true,
    //     });
    //     item.gallery_id = gallery.id;
    //   }

    //   if (this.images.length > 0) {
    //     this.images.map((image) => {
    //       if(image.id){
    //         this.$store.dispatch('media/delete',{id:image.id});
    //       }
    //       if (!image.id) {
    //         image = {
    //           file: image,
    //           gallery_id: gallery_id||gallery.id,
    //           is_file: true,
    //         };

    //         this.$store.dispatch("media/store", image);
    //       }
    //     });
    //   }

    //   let item_data = await this.$store.dispatch("item/store", item);

    //   if (this.tags.length > 0) {
    //     let tags_data = {
    //       item_id: item_data.id,
    //       tags: this.tags,
    //     };
    //     this.$store.dispatch("item_tags/store", tags_data);
    //   }
    //   this.$router.push("/items");
    // },

    async saveSlider() {
      for (let i in this.slider) {
        let image = await this.image_upload(this.slider[i].image);
        this.slider[i].image = image.url;
      }
      this.$store.dispatch("setting/store", {
        key: "slider",
        value: JSON.stringify(this.slider),
      });
      this.slider = null;
    },
  },
  computed: {
    ...mapState({
      items: (state) => state.item.all,
      posts: (state) => state.post.all,
      settings: (state) => state.setting.all,
      locales: (state) => state.locales.all,
    }),
  },
  watch: {
    settings: {
      handler() {
        if (this.settings) {
          this.slider = this.settings.slider || [];
          this.featured_items = this.settings.featured_items || [];
          this.featured_posts = this.settings.featured_posts || [];
          this.clients = this.settings.clients || [];
          this.partners = this.settings.partners || [];
          this.why_choose_us = this.settings.WhyChooseUs || [];
          this.advertisings = this.settings.advertisings || [];
        }
      },
      deep: true,
    },
  },
};
</script>

<style scoped>
/* <v-card-text v-for="choose in why_choose_us">
                <v-row v-if="choose.image">
                  <v-col cols="3">
                    <v-file-input
                      dense
                      v-model="choose.image"
                      :label="$t('image')"
                      hide-details
                      v-if="!choose.image"
                    ></v-file-input>
                    <v-text-field
                      clearable
                      v-model="choose.image"
                      v-if="choose.image"
                    ></v-text-field>
                    <v-img
                      v-if="choose.image"
                      :src="get_url(choose.image)"
                      width="300"
                    >
                    </v-img>
                  </v-col>

                  <v-row v-for="translation in choose.translation">
                    <v-col>
                      <v-autocomplete
                        dense
                        v-model="translation.locale"
                        label="Choose language"
                        :items="locales"
                        item-text="locale.native_name"
                        item-value="locale.iso_639"
                      >
                      </v-autocomplete>
                    </v-col>
                    <v-col>
                      <v-text-field
                        clearable
                        dense
                        v-model="translation.title"
                        label="Title"
                      >
                      </v-text-field>
                    </v-col>
                    <v-col>
                      <v-text-field
                        clearable
                        dense
                        v-model="translation.text"
                        label="Text"
                      >
                      </v-text-field>
                    </v-col>

                    <v-col>
                      <v-btn
                        icon
                        @click="choose.translation.push({ locale: 'ar' })"
                      >
                        <v-icon> fas fa-plus </v-icon>
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-row>








                <v-row v-for="item in choose.items">
                  <v-col v-if="item.image" cols="3">
                    <v-file-input
                      dense
                      v-model="item.image"
                      :label="$t('image')"
                      hide-details
                      v-if="!item.image"
                    ></v-file-input>
                    <v-text-field
                      clearable
                      v-model="item.image"
                      v-if="item.image"
                    ></v-text-field>
                    <v-img
                      v-if="item.image"
                      :src="get_url(item.image)"
                      width="300"
                    >
                    </v-img>
                  </v-col>
                  <v-row v-for="(translation, w) in item.translation">
                    <v-col>
                      <v-btn
                        icon
                        @click="item.translation.push({ locale: 'ar' })"
                      >
                        <v-icon> fas fa-plus </v-icon>
                      </v-btn>
                    </v-col>
                    <v-col>
                      <v-autocomplete
                        dense
                        v-model="translation.locale"
                        label="Choose language"
                        :items="locales"
                        item-text="locale.native_name"
                        item-value="locale.iso_639"
                        clearable
                      >
                      </v-autocomplete>
                    </v-col>
                    <v-col>
                      <v-text-field
                        clearable
                        dense
                        v-model="translation.title"
                        label="Item Title"
                      >
                      </v-text-field>
                    </v-col>
                    <v-col>
                      <v-text-field
                        dense
                        v-model="translation.text"
                        label="Item Title"
                        clearable
                      >
                      </v-text-field>
                    </v-col>
                  </v-row>
                </v-row>
              </v-card-text> */
</style>