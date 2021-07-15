<template>
  <v-dialog v-model="open" persistent width="1200">
    <v-card>
      <v-card-title>
        <v-spacer></v-spacer>
        {{ $t("accessories_picker") }}
        <v-spacer></v-spacer>
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="12" md="2" v-for="city in accessories" :key="city">
            <v-card>
              <v-card-title style="font-size: 18px">
                <v-spacer></v-spacer>
                {{ city.name }}
                <v-spacer></v-spacer>
              </v-card-title>
              <v-card-text>
                <v-img
                  :src="city.image.url"
                  :style="`text-align:center;padding:5px;font-size:1rem;${
                    city.id != city_id && city_id != null
                      ? 'filter:grayscale(100%);'
                      : 'filter:grayscale(0%);'
                  }`"
                >
                </v-img>
              </v-card-text>
              <v-card-actions>
                <v-row justify="center">
                  <v-btn
                    icon
                    @click="city_id = !city_id ? city.id : null"
                    :color="`${city.id == city_id ? 'red' : 'gray'}`"
                  >
                    <v-icon small> fas fa-heart </v-icon>
                  </v-btn>

                  <v-btn
                    icon
                    @click="
                      selected_city = city;
                      explore = true;
                    "
                  >
                    <v-icon small> fas fa-eye </v-icon>
                  </v-btn>
                </v-row>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>

      </v-card-text>
      <v-card-actions>

        <v-spacer></v-spacer>
        <v-btn
          @click="
            $emit('closed');
            $emit('input', city_id);
            city_id=null;
          "
          dark
          color="red"
        >
          {{ $t("close") }}
        </v-btn>
        <v-spacer></v-spacer>
        
      </v-card-actions>
    </v-card>
     <!-- <v-dialog v-model="explore" width="550">
      <v-card v-if="selected_city != null">
        <v-card-title>
          {{ selected_city.name }}
        </v-card-title>
        <v-card-text>
          <v-carousel
            v-model="model"
            :cycle="true"
            :show-arrows="true"
            hide-delimiter-background
            delimiter-icon="mdi-minus"
            height="500"
          >
            <v-carousel-item
              v-for="image in selected_city.gallery.media"
              :key="image.id"
            >
              <v-sheet height="100%" tile>
                <v-row class="fill-height" align="center" justify="center">
                  <v-img :src="image.url"></v-img>
                </v-row>
              </v-sheet>
            </v-carousel-item>
          </v-carousel>
        </v-card-text>
      </v-card>
    </v-dialog> -->
  </v-dialog>
</template>
<script>
export default {
  props: {
    accessories: {
      default: () => [],
    },
    open: Boolean,
  },
  data() {
    return {
      city_id: null,
      selected_city: null,
      explore: false,
      model: 0,
      city_selected: false,
    };
  },
};
</script>