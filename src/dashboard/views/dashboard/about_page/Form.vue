<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component :heading="$t('About_Form')" />

    <base-material-card
      icon="mdi-clipboard-text"
      title="Item Form"
      class="px-5 py-3"
    >
      <v-form>
        <v-row>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                <v-row>
                  <v-col cols="10">
                    {{ $t("main_content") }}
                  </v-col>
                  <v-col>
                    <v-btn
                      icon
                      @click="
                        content.paragraphs.push({
                          image: null,
                          translations: [
                            {
                              locale: '',
                              title: '',
                              text: '',
                            },
                          ],
                        })
                      "
                    >
                      <v-icon>fas fa-plus</v-icon></v-btn
                    >
                  </v-col>
                </v-row>
              </v-card-title>
              <v-card-text>
                <v-row :key="paragraph" v-for="paragraph in content.paragraphs">
                  <v-row>
                    <v-col>
                      <v-row v-for="p in paragraph.translations">
                        <v-col cols="2">
                          <v-autocomplete
                            v-model="p.locale"
                            :items="locales"
                            item-text="locale.native_name"
                            item-value="locale.iso_639"
                          >
                          </v-autocomplete>
                        </v-col>
                        <v-col>
                          <v-text-field
                            :label="$t('title')"
                            v-model="p.title"
                          ></v-text-field>
                        </v-col>
                        <v-col>
                          <ckeditor
                            :editor="editor"
                            v-model="p.text"
                            :config="editorConfig"
                          ></ckeditor>
                        </v-col>
                        <v-col>
                          <v-btn @click="paragraph.translations.push({})">
                            <v-icon> fas fa-plus </v-icon>
                          </v-btn>
                        </v-col>
                      </v-row>
                    </v-col>

                    <v-col>
                      <v-file-input
                        v-model="paragraph.image"
                        :label="$t('image')"
                        hide-details
                        v-if="!paragraph.image"
                      ></v-file-input>
                      <v-text-field
                        clearable
                        v-model="paragraph.image"
                        v-if="paragraph.image"
                      ></v-text-field>
                      <v-img
                        v-if="paragraph.image"
                        :src="get_url(paragraph.image)"
                        width="300"
                      >
                      </v-img>
                    </v-col>
                  </v-row>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="saveContent">
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
                    {{ $t("counters") }}
                  </v-col>
                  <v-col>
                    <v-btn icon @click="counters.push({})">
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="4" v-for="(counter, i) in counters">
                    <v-row>
                      <v-col cols="10">
                        <v-text-field
                          :label="$t('title')"
                          v-model="counter.title"
                        >
                        </v-text-field>
                        <v-text-field
                          :label="$t('value')"
                          v-model="counter.value"
                        >
                        </v-text-field>
                      </v-col>
                      <v-col cols="2">
                        <v-btn icon @click="counters.splice(i, 1)">
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
            <v-btn dark color="primary" block @click="saveCounters">
              <v-icon> mdi-check </v-icon>
              {{ $t("save") }}
            </v-btn>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-card flat>
              <v-card-title>
                <v-row>
                  <v-col cols="10">
                    {{ $t("paragraphs") }}
                  </v-col>
                  <v-col>
                    <v-btn
                      icon
                      @click="
                        multi_p.paragraphs.push({
                          translations: [
                            {
                              locale: '',
                              title: '',
                              text: '',
                            },
                          ],
                        })
                      "
                    >
                      <v-icon>fas fa-plus</v-icon></v-btn
                    >
                  </v-col>
                </v-row>
              </v-card-title>
              <v-card-text>
                <v-row>
                  <v-col>
                    <v-file-input
                      v-model="multi_p.image"
                      :label="$t('image')"
                      hide-details
                      v-if="!multi_p.image"
                    ></v-file-input>
                    <v-text-field
                      clearable
                      v-model="multi_p.image"
                      v-if="multi_p.image"
                    ></v-text-field>
                    <v-img
                      v-if="multi_p.image"
                      :src="get_url(multi_p.image)"
                      width="300"
                    >
                    </v-img>
                  </v-col>
                </v-row>

                <v-row :key="paragraph" v-for="paragraph in multi_p.paragraphs">
                  <v-card color="#f5f5f5">
                    <v-col>
                      <v-row v-for="p in paragraph.translations">
                        <v-col cols="2">
                          <v-autocomplete
                            v-model="p.locale"
                            :items="locales"
                            item-text="locale.native_name"
                            item-value="locale.iso_639"
                          >
                          </v-autocomplete>
                        </v-col>
                        <v-col>
                          <v-text-field
                            :label="$t('title')"
                            v-model="p.title"
                          ></v-text-field>
                        </v-col>
                        <v-col>
                          <ckeditor
                            :editor="editor"
                            v-model="p.text"
                            :config="editorConfig"
                          ></ckeditor>
                        </v-col>
                        <v-col>
                          <v-btn @click="paragraph.translations.push({})">
                            <v-icon> fas fa-plus </v-icon>
                          </v-btn>
                        </v-col>
                      </v-row>
                    </v-col>
                  </v-card>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="saveParagraph">
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
                    {{ $t("team") }}
                  </v-col>
                  <v-col cols="2">
                    <v-btn
                      icon
                      @click="
                        team.push({
                          facebook: null,
                          instagram: null,
                          twitter: null,
                          image: null,
                          translations: [{ name: '', title: '', locale: 'en' }],
                        })
                      "
                    >
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card-title>
              <v-card-text>
                <v-row v-for="(item, i) in team" style="margin:15px;background-color:#f5f5f5;border:lightgray solid 1px;">
                  <v-col cols="3">
                    <v-row>
                      <v-col> <v-btn
                      icon
                      @click="item.translations.push({locale: 'en'})"
                    >
                      <v-icon> fas fa-plus </v-icon>
                    </v-btn>
                    <v-btn icon @click="team.splice(i, 1)">
                      <v-icon> fas fa-times </v-icon>
                    </v-btn></v-col>
                    </v-row>
                    <v-file-input
                      clearable
                      v-model="item.image"
                      :label="$t('image')"
                      hide-details
                    ></v-file-input>
                    <v-img
                      v-if="item.image"
                      :src="get_url(item.image)"
                      width="300"
                    >
                    </v-img>
                  </v-col>

                  <v-col cols="3" v-for="translation in item.translations" >
                    <v-text-field
                      v-model="translation.name"
                      :label="$t('name')"
                    >
                    </v-text-field>
                    <v-text-field
                      v-model="translation.title"
                      :label="$t('title')"
                    />
                    <v-autocomplete
                      dense
                      v-model="translation.locale"
                      :items="locales"
                      item-text="locale.native_name"
                      item-value="locale.iso_639"
                    >
                    </v-autocomplete>
                  </v-col>

                  <v-col cols="3">

                  <v-row>
                    <v-col >
                      <v-text-field
                        prepend-inner-icon="fab fa-facebook"
                        v-model="item.facebook"
                      ></v-text-field>
                    </v-col>
                    <v-col >
                      <v-text-field
                        prepend-inner-icon="fab fa-instagram"
                        v-model="item.instagram"
                      ></v-text-field>
                    </v-col>
                    <v-col >
                      <v-text-field
                        prepend-inner-icon="fab fa-twitter"
                        v-model="item.twitter"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  </v-col>
                  <v-col cols="4"> </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="saveTeam">
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
  name: "about_page_form",
  props: {
    item: {
      default: () => {
        return {};
      },
    },
  },
  data() {
    return {
      slider: [],
      featured_items: [],
      featured_posts: [],
      clients: [],
      partners: [],
      content: {
        paragraphs: [],
      },
      multi_p: {
        image: null,
        paragraphs: [],
      },
      counters: [],
      paragraph: {
        image: null,
        menus: [],
      },
      team: [
        {
          facebook: null,
          instagram: null,
          twitter: null,
          image: null,
          translations: [{ name: "name", title: "title", locale: "ar" }],
        },
      ],
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
        language: this.$store.state.locales.locale,
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
    this.$store.dispatch("setting/index");
    this.$store.dispatch("locales/index");
  },
  methods: {
    ...mapActions("accessor", ["store"]),
    get_url(image) {
      let binary = [];
      binary.push(image);
      return typeof image != "string"
        ? window.URL.createObjectURL(
            new Blob(binary, { type: "application/zip" })
          )
        : image;
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
    async saveTeam() {
      for (let i in this.team) {
        let image = await this.image_upload(this.team[i].image);
        this.team[i].image = image.url;
      }
      this.$store.dispatch("setting/store", {
        key: "team",
        value: JSON.stringify(this.team),
      });
    },

    async saveParagraph() {
      let image = await this.image_upload(this.multi_p.image);
      this.multi_p.image = image.url;
      this.$store.dispatch("setting/store", {
        key: "multi_p",
        value: JSON.stringify(this.multi_p),
      });
    },

    async saveContent() {
      let paragraphs = this.content.paragraphs;
      for (let index = 0; index < this.content.paragraphs.length; index++) {
        let image = await this.image_upload(
          this.content.paragraphs[index].image
        );
        this.content.paragraphs[index].image = image.url;
      }

      this.$store.dispatch("setting/store", {
        key: "content",
        value: JSON.stringify(this.content),
      });
    },

    async saveCounters() {
      this.$store.dispatch("setting/store", {
        key: "counters",
        value: JSON.stringify(this.counters),
      });
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
          this.content = this.settings.content || { paragraphs: [] };
          this.paragraph = this.settings.paragraph || { menus: [] };
          this.counters = this.settings.counters || [];
          this.team = this.settings.team || [];
          this.multi_p = this.settings.multi_p || { image: "", paragraphs: [] };
        }
      },
      deep: true,
    },
  },
};
</script>

