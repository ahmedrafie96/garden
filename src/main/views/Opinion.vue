<template>
  <v-row justify="center">
    <v-card style="padding: 30px" class="mb-10" width="600" elevation="23">
      <v-card-title>
        <v-spacer></v-spacer>
        <span class="headline">{{ $t("Become a Friend") }}</span>
        <v-spacer></v-spacer>
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-spacer></v-spacer>
          <input
            v-show="false"
            ref="inputUpload"
            type="file"
            @change="handleFileUpload"
          />
          <v-avatar
            width="120"
            height="120"
            v-if="!image"
            color="indigo"
            @click="$refs.inputUpload.click()"
            style="cursor: pointer"
            :title="$t('add_photo')"
          >
            <v-icon large dark>mdi-account-circle</v-icon>
          </v-avatar>
          <v-avatar
            v-if="image"
            width="120"
            height="120"
            style="cursor: pointer"
            :title="$t('replacec_photo')"
            @click="$refs.inputUpload.click()"
          >
            <img v-if="image" :src="get_url(image)" width="120" height="120" />
            <!-- <img
              width="80"
              height="80"
              src="https://cdn.vuetifyjs.com/images/john.jpg"
              alt="John"
            /> -->
          </v-avatar>

          <v-spacer></v-spacer>
        </v-row>
        <v-row justify="center" v-if="!image">
          <v-spacer></v-spacer>
          <v-spacer></v-spacer>
          <v-btn icon nuxt>
            <v-icon color="blue" class="mr-2">mdi-facebook </v-icon>
            add photo using Facebook
          </v-btn>

          <v-spacer></v-spacer>
          <v-spacer></v-spacer>
        </v-row>

        <v-divider class="mt-9 mb-9"></v-divider>
        <v-spacer></v-spacer>
        <v-row>
          <v-text-field v-model="name" dense outlined>
            <template v-slot:label>
              <!-- <strong > أدخل اسمك من فضلك </strong> -->
              <strong> {{ $t("Enter Your Name") }} </strong>
            </template>
          </v-text-field>
        </v-row>

        <v-row>
          <v-textarea v-model="textOpinion" outlined :label="$t('Add Opinion')">
            <!-- <v-textarea v-model="textOpinion" outlined :label="أكتب تعليقك" > -->
          </v-textarea>
        </v-row>
      </v-card-text>
      <v-row justify="center">
        <v-card-action>
          <v-btn color="blue" depressed @click="save"> submit </v-btn>
        </v-card-action>
      </v-row>
    </v-card>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      image: null,
      textOpinion: null,
      name: null,
    };
  },
  mounted(){
    window.scrollTo(0,0);
  },
  methods: {
    get_url(image) {
      return URL.createObjectURL(image);
    },
    handleFileUpload(e) {
      console.log(e);
      let file = e.target.files;
      this.image = file[0];
      // for (var i = 0; i < files.length; i++) {
      //   this.images.push(files[i]);
      // }
      // for( let file in e.target.files)
      // this.images.concat(e.target.files);
    },
  async save() {
    let image = {
      file: this.image,
      gallery_id: 1,
      is_file: true,
    };
    let media = await this.$store.dispatch("media/store", image);
    this.$store.dispatch("friend/store", {
      image_id: media.id,
      name: this.name,
      content: this.textOpinion,
    });
  },
  },

};
</script>

<style>
* {
}
</style>