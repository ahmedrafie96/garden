<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component heading="tasks_confirmation_form" />

    <base-material-card
      icon="mdi-clipboard-text"
      title="Task Confirmation Form"
      class="px-5 py-3"
    >
      <v-form>
        <v-row>
          <v-col cols="3">
            <v-autocomplete
              v-model="item.task_id"
              :label="$t('task')"
              :items="tasks"
              :item-text="(v) => v.id"
              item-value="id"
            />
          </v-col>
          <v-col cols="3">
            <v-autocomplete
              v-model="item.post_id"
              :label="$t('post')"
              :items="posts"
              :item-text="(v) => v.id"
              item-value="id"
            />
          </v-col>
          <v-col cols="3">
            <v-text-field
              v-model="item.tree_number"
              :label="$t('tree_number')"
            />
          </v-col>
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
          <v-col cols="3">
            <v-autocomplete
              v-model="item.country_id"
              item-text="name"
              item-value="id"
              :items="countries"
              :label="$t('Country')"
            />
          </v-col>
          <v-col cols="3">
            <v-autocomplete
              v-model="item.city_id"
              :items="cities"
              item-text="name"
              item-value="id"
              :label="$t('City')"
            />
          </v-col>
        </v-row>

        <v-row>
          <v-card>
            <v-card-title>
              {{ $t("final_location") }}
            </v-card-title>
            <v-card-text>
              <v-col cols="12">
                <GmapMap
                  :center="center"
                  :zoom="18"
                  map-style-id="roadmap"
                  :options="mapOptions"
                  style="width: 100vmin; height: 50vmin"
                  ref="mapRef"
                  @click="handleMapClick"
                >
                  <GmapMarker
                    :position="marker.position"
                    :clickable="true"
                    :draggable="true"
                    @drag="handleMarkerDrag"
                    @click="panToMarker"
                  />
                </GmapMap>
              </v-col>
            </v-card-text>
          </v-card>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                {{ $t("task_images") }}
              </v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="4" :key="index" v-for="(image, index) in images">
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
      default: () => {
        return {};
      },
    },
  },
  data() {
    return {
      images: [],
      marker: {
        position: { lat: 31.776488733539026, lng: 35.234707318589045 },
      },
      center: { lat: 31.776488733539026, lng: 35.234707318589045 },

      mapOptions: {
        disableDefaultUI: true,
      },
      cover_image: null,
    };
  },
  mounted() {
    this.$store.dispatch("purchase_task/index");
    this.$store.dispatch("post/index");
    this.$store.dispatch("country/index");
    this.$store.dispatch("city/index");
  },
  methods: {
    ...mapActions("task_confirmation", ["store"]),
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
    handleMarkerDrag(e) {
      this.marker.position = { lat: e.latLng.lat(), lng: e.latLng.lng() };
    },

    //Moves the map view port to marker
    panToMarker() {
      this.$refs.mapRef.panTo(this.marker.position);
      this.$refs.mapRef.setZoom(18);
    },

    //Moves the marker to click position on the map
    handleMapClick(e) {
      this.marker.position = { lat: e.latLng.lat(), lng: e.latLng.lng() };
      console.log(e);
    },
    async save(item) {
      // this.$store.dispatch("country/store", this.item.country);
      // this.$store.dispatch("city/store", this.item.city);
      let gallery = await this.$store.dispatch("gallery/store", {
        name: this.item.task_id || null,
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
      this.$store.dispatch("task_confirmation/store", item);
    },
  },
  computed: {
    ...mapState({
      tasks: (state) => state.purchase_task.all,
      posts: (state) => state.post.all,
      countries: (state) => state.country.all,
      cities: (state) => state.city.all,
    }),
  },
};
</script>