<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component heading="gardners_form" />

    <base-material-card
      icon="mdi-clipboard-text"
      title="Item Form"
      class="px-5 py-3"
    >
      <v-form>
        <v-row>
          <v-col cols="3">
            <v-text-field v-model="item.first_name" :label="$t('first_name')" />
          </v-col>
          <v-col cols="3">
            <v-text-field
              v-model="item.middle_name"
              :label="$t('middle_name')"
            />
          </v-col>
          <v-col cols="3">
            <v-text-field v-model="item.last_name" :label="$t('last_name')" />
          </v-col>
          <v-col cols="3">
            <v-text-field v-model="item.email" :label="$t('email')" />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="3">
            <v-text-field v-model="item.mobile" :label="$t('mobile')" />
          </v-col>
          <v-col cols="3">
            <v-text-field
              type="password"
              v-model="item.password"
              :label="$t('password')"
            />
          </v-col>
          <v-col cols="3">
            <v-text-field
              type="password"
              v-model="c_password"
              :label="$t('password_confirmation')"
              :rules="[(v) => v == item.password || $t('passwords dont match')]"
              validate-on-blur
            />
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
      default: () => {
        return {};
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
    // this.$store.dispatch("category/index");
  },
  methods: {
    ...mapActions("gardner", ["store"]),
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
    }),
  },
};
</script>