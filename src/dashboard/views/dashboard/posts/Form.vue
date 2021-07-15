<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component heading="posts_form" />

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
                (i) => i.field == 'title'
              )"
              v-model="translation.value"
              :label="$t('title')"
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
                          i.field == 'title' && i.locale == translation.locale
                      ),
                      1
                    )
                  "
                >
                  <v-icon> fas fa-times </v-icon>
                </v-btn>
                <v-btn @click="item.translations.push({ field: 'title' })" icon>
                  <v-icon> fas fa-plus </v-icon>
                </v-btn>
              </template>
            </v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
              v-for="(translation, index) in item.translations.filter(
                (i) => i.field == 'summary'
              )"
              v-model="translation.value"
              :label="$t('summary')"
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
                          i.field == 'summary' && i.locale == translation.locale
                      ),
                      1
                    )
                  "
                >
                  <v-icon> fas fa-times </v-icon>
                </v-btn>
                <v-btn @click="item.translations.push({ field: 'summary' })" icon>
                  <v-icon> fas fa-plus </v-icon>
                </v-btn>
              </template>
            </v-text-field>
          </v-col>
          <v-col cols="6">
            <v-autocomplete
              :items="categories"
              item-value="id"
              item-text="name"
              v-model="item.category_id"
              :label="$t('category')"
            />
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
        <v-row
          v-for="(translation, index) in item.translations.filter(
            (i) => i.field == 'content'
          )"
        >
          <v-col cols="2">
            <v-autocomplete
              dense
              v-model="translation.locale"
              :items="locales"
              item-text="locale.native_name"
              item-value="locale.iso_639"
            >
            </v-autocomplete>
          </v-col>
          <v-col cols="8">
            <!-- <v-textarea
             v-model="translation.value"
             label="Post Conetnt"
            >
              
            </v-textarea> -->
            <ckeditor
              :editor="editor"
              v-model="translation.value"
              :config="editorConfig"
            ></ckeditor>
          </v-col>
          <v-col cols="2">
            <v-btn
              icon
              v-if="index > 0"
              @click="
                item.translations.splice(
                  item.translations.findIndex(
                    (i) =>
                      i.field == 'content' && i.locale == translation.locale
                  ),
                  1
                )
              "
            >
              <v-icon> fas fa-times </v-icon>
            </v-btn>
            <v-btn @click="item.translations.push({ field: 'content' })" icon>
              <v-icon> fas fa-plus </v-icon>
            </v-btn>
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import UploadAdapter from "../../../plugins/uploadAdapter";
function UploadAdapterPlugin(editor) {
  editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
    return new UploadAdapter(loader);
  };
}
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
              field: "title",
            },
            {
              locale: "ar",
              field: "summary",
            },
            {
              locale: "ar",
              field: "content",
            },
          ],
        };
      },
    },
  },
  data() {
    return {
      images: [],
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
     language:this.$store.state.locales.locale,
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
      cover_image: null,
    };
  },
  mounted() {
    // this.$store.dispatch("type/index");
    this.$store.dispatch("category/index");
    this.$store.dispatch("locales/index");
  },
  methods: {
    ...mapActions("post", ["store"]),
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
      this.item.gallery_id = gallery.id;
      this.$store.dispatch("post/store", item);
    },
  },
  computed: {
    ...mapState({
      categories: (state) => state.category.all,
      locales: (state) => state.locales.all,
    }),
  },
};
</script>