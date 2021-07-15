<template>
  <v-pagination
    v-model="options.page"
    :length="meta.last_page"
    circle
  ></v-pagination>
</template>
<script>
import { mapState } from "vuex";
export default {
  props: ["module"],
  mounted() {
    this.$store.dispatch(this.module + "/index");
  },
  computed: {
    ...mapState({
      meta: (state) => state[this.module].meta,
    }),
  },
  data() {
    return {
      options: {
        page: 0,
      },
    };
  },
  watch: {
    options: {
      handler: function (val) {
        this.$store.dispatch(this.module + "/index", {
          page: val.page,
        });
      },
      deep: true,
    },
  },
};
</script>
