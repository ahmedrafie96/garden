<template>
  <v-container>
    <v-card flat>
        <v-card flat>
          <v-card-title class="text-center">
            <v-row justify="center" style="font-weight: bold" class="ma-5">
              {{ paragraph.title.value }}
            </v-row>
          </v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="6">
                <v-img :src="paragraph.image"></v-img>
              </v-col>
              <v-col align-self="center" cols="6" v-html="paragraph.text.value">
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
    </v-card>
    <v-divider></v-divider>
  </v-container>
</template>

<script>
export default {
  name: "aboutUsComponent",
  props: ["paragraph"],
};
</script>

<style>
</style>