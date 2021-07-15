<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component heading="tasks_form" />

    <base-material-card
      icon="mdi-clipboard-text"
      title="Item Form"
      class="px-5 py-3"
    >
      <v-form>
        <v-row>
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
        </v-row>
        <v-row>
          <v-col cols="3">
            <v-autocomplete
              v-model="item.country"
              item-text="name"
              item-value="id"
              :items="countries"
              :label="$t('Country')"
            />
          </v-col>
          <v-col cols="3">
            <v-autocomplete
              v-model="item.city"
              :items="cities"
              item-text="name"
              item-value="id"
              :label="$t('City')"
            />
          </v-col>
          <v-col cols="3">
            <v-text-field v-model="item.code" :label="$t('discreption')" />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-btn dark color="primary" block @click="save()">
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
        return {
          country: null,
          city: null,
        };
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
    };
  },
  mounted() {
    this.$store.dispatch("order/index");
    this.$store.dispatch("gardner/index");
    this.$store.dispatch("country/index");
    this.$store.dispatch("city/index");
  },
  methods: {
    ...mapActions("task", ["store"]),
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
    save() {
      this.$store.dispatch("country/store", this.item.country);
      this.$store.dispatch("city/store",this.item.city);
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
  },
  computed: {
    ...mapState({
      purchases: (state) => state.purchase.all,
      orders: (state) => state.order.all,
      gardners: (state) => state.gardner.all,
      countries: (state) => state.country.all,
      cities: (state) => state.city.all,
    }),
  },
};
</script>