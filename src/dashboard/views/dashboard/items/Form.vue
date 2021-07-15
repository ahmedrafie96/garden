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
          <v-col cols="3">
            <v-text-field
              :key="index"
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
                        (i) =>i.field == 'name' && i.locale == translation.locale),1)">
                  <v-icon> fas fa-times </v-icon>
                </v-btn>
                <v-btn @click="item.translations.push({ field: 'name' })" icon>
                  <v-icon> fas fa-plus </v-icon>
                </v-btn>
              </template>
            </v-text-field>
          </v-col>
          <!-- <v-col cols="3">
            <v-autocomplete
              dense
              v-model="item.parent_id"
              :items="items"
              item-text="name"
              item-value="id"
              :label="$t('accessor_for')"
            >
            </v-autocomplete>
          </v-col> -->
          <v-col cols="3">
            <v-text-field v-model="item.code" :label="$t('code')" />
          </v-col>
          <v-col cols="3">
            <v-text-field v-model="item.price" :label="$t('price')" />
          </v-col>
          <v-col cols="3">
            <v-autocomplete
             :disabled="item.item_type == 1  ? true:false"

              :items="categories"
              item-text="name"
              item-value="id"
              v-model="item.categories"
              multiple
              :label="$t('category')"
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col>
         <v-checkbox
         @click="clearCategories"
          :value="1"
           v-model="item.item_type"
           :label="$t('add_as_accessory')"
         ></v-checkbox>
          </v-col>
          <v-col cols="3">
            <v-file-input
              v-model="cover_image.url"
              :label="$t('cover_image')"
              hide-details
            ></v-file-input>
            <v-img
              v-if="cover_image.url"
              :src="get_url(cover_image)"
              width="300"

            >
            </v-img>
            <!-- <v-img :src="get_url(image)" width="300"></v-img> -->
          </v-col>
          <v-col>
            <v-text-field type="number" suffix="Inches"  v-model="item.radius" :label="$t('trunk_radius')">

            </v-text-field>
          </v-col>
          <v-col>
            <v-text-field  type="number" suffix="Meters"  v-model="item.height" :label="$t('tree_height')">

            </v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col>

          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-autocomplete
            clearable
              v-model="new_tag"
              :items="tags"
              item-text="name"
              item-value="id"
              outlined
              dense
              chips
              small-chips
              :label="$t('add_tag')"
              multiple
              append-icon="fas fa-plus"
              @click:append="runDialog()"
            ></v-autocomplete>
                <!-- @click:append="tags.push({ name: new_tag })" -->


            <v-dialog v-model="dialog" width="500">

              <v-card>
              <v-card-title>
                {{ $t('Add New Tag') }}
              </v-card-title>
              <v-card-text>
                <v-text-field
                v-model="NewTags.name"
      
                :label="$t('name')"
                >
                </v-text-field>
              </v-card-text>
              <v-card-actions>
                <v-btn
                :disabled="!NewTags.name"
                @click='$store.dispatch("tag/store" ,NewTags )'
                class="success">
                  {{ $t('add_tag') }}
                </v-btn>
              </v-card-actions>
              </v-card>
            </v-dialog>



          </v-col>
          <!-- <v-col cols="12">
            <v-chip
              v-for="(tag, index) in tags"
              class="ma-2"
              close
              color="primary"
              text-color="white"
              close-icon="mdi-delete"
              @click:close="tags.splice(index, 1)"
              :key="index"
            >
              {{ tag.name }}
            </v-chip>
          </v-col> -->
        </v-row>
        <v-row   
        :key="index"
          v-for="(translation, index) in item.translations.filter(
            (i) => i.field == 'brief'
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
            <v-textarea
             v-model="translation.value"
             :label="$t('Item_brief')"
             dense
            >

            </v-textarea>
          </v-col>
          <v-col cols="2">
            <v-btn
              icon
              v-if="index > 0"
              @click="
                item.translations.splice(
                  item.translations.findIndex((i) =>i.field == 'brief' && i.locale == translation.locale),1)" >
              <v-icon> fas fa-times </v-icon>
            </v-btn>
            <v-btn
              @click="item.translations.push({ field: 'brief' })"
              icon
            >
              <v-icon> fas fa-plus </v-icon>
            </v-btn>
          </v-col> 
          </v-row>

        <v-row
          :key="index"
          v-for="(translation, index) in item.translations.filter(
            (i) => i.field == 'description'
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
            <!-- <v-text-field
             v-model="translation.value"
             label="Item Discription"
             dense
            >

            </v-text-field> -->
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
                      i.field == 'description' && i.locale == translation.locale
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
          </v-col> </v-row
        ><v-row>
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
                                @click="remove_image(image, index)"
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import UploadAdapter from "../../../plugins/uploadAdapter";
function UploadAdapterPlugin(editor) {
  editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
    return new UploadAdapter(loader);
  };
}
export default {
  name:'ItemForm',
  props: {
    item: {
      type: Object,
      translations: Array,
      categories: Array,
      default: () => {
        return {
         item_type:0 ,
          translations: [
            {
              locale: "ar",
              field: "name",
            },
            {
              locale: "ar",
              field: "description",
            },
            {
              locale: "ar",
              field: "brief",
            },
          ],
          categories: [],
        };
      },

    },
  },
  data() {
    return {
      radio:null ,
      NewTags:{name:null},
       dialog:false,
      images: [],
      cover_image: {
        id: null,
        url: null,
      },
      editor: ClassicEditor,
      new_tag: null,
      editorConfig: {
        toolbar: {
          items: [
            "heading",
            "|",
            "bold",
            "fontFamily",
            "fontBackgroundColor",
            "fontColor",
            "fontSize",
            "italic",
            "highlight",
            "link",
            "bulletedList",
            "numberedList",
            "removeFormat",
            "strikethrough",
            "superscript",
            "subscript",
            "underline",
            "|",
            "alignment",
            "indent",
            "outdent",
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
    };
  },
  mounted() {
    // this.$store.dispatch("type/index");
    this.$store.dispatch("category/index");
    this.$store.dispatch("locales/index");
    this.$store.dispatch("item/index");
    this.$store.dispatch("tag/index");
    if (this.$props.item.id) {
      this.$store
        .dispatch("item/show", { id: this.$props.item.id })
        .then((res) => {
          this.cover_image = res.gallery.cover_image;
          this.item.categories = res.category_ids;
          this.images = res.gallery.media;
        });
    }
    if (this.translations.find((i) => i.field == "description") == undefined) {
      console.log("test");
      this.$props.translations.push({
        locale: "ar",
        field: "description",
      });
    }
  },
  methods: {
    clearCategories(){
      this.item.item_type == 1 ? this.item.categories= null :''
    },
    AddNew_Item(){
      this.NewTags.push(this.NewTags)

    },
    runDialog(){
      this.dialog = !this.dialog
    },
    ...mapActions("item", ["store"]),

    // get_url(image) {

    //   return typeof image.url != "string" ? URL.createObjectURL(image.url) : image.url;
    // },

    get_url(image) {
      return typeof image.url != "string"
        ? URL.createObjectURL(image.url)
        : image.url;
    },

    handleFileUpload(e) {
      console.log(e);
      let files = e.target.files;
      for (var i = 0; i < files.length; i++) {
        this.images.push({ url: files[i] });
      }
      // for( let file in e.target.files)
      // this.images.concat(e.target.files);
    },

    async save(item) {
      let gallery_id = item.gallery_id;
      if (item.gallery_id) {
        if (typeof this.cover_image.url != "string") {
          this.$store.dispatch("gallery_cover/store", {
            gallery_id: item.gallery_id,
            cover_image: this.cover_image.url,
            is_file: true,
            gallery_id: item.gallery_id,
          });
        }
      } else {
        let gallery = await this.$store.dispatch("gallery/store", {
          name: this.item.name,
          cover_image: this.cover_image.url,
          is_file: true,
        });
        item.gallery_id = gallery.id;
        gallery_id = gallery.id;
      }

      if (this.images.length > 0) {
        this.images.map((image) => {
          if (image.id) {
            this.$store.dispatch("gallery_media/delete", { image });
          }
          if (!image.id) {
            image = {
              file: image.url,
              gallery_id: gallery_id,
              is_file: true,
            };
            console.table(image);
            this.$store.dispatch("gallery_media/store", image);
          }
        });
      }

      let item_data = await this.$store.dispatch("item/store", item);

      if (this.new_tag.length > 0) {
        let tags_data = {
          item_id: item_data.id,
          tags: this.new_tag, 
        };
        this.$store.dispatch("item_tags/store", tags_data);
      }
      // this.$router.push("/items");
    },

    remove_image(image, index) {
      if (image.id) {
        this.$store.dispatch("gallery_media/delete", {
          gallery_id: image.gallery_id,
          id: image.id,
        });
      }
      this.images.splice(index, 1);
    },
  },

  computed: {
    ...mapState({
      // types: (state) => state.type.all,
      categories: (state) => state.category.all,
      locales: (state) => state.locales.all,
      items: (state) => state.item.all,
      tags:(state) =>state.tag.all
    }),
  },

};
</script>