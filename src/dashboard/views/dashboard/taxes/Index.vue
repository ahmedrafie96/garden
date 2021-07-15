<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component heading="taxes" />

    <base-material-card
      icon="mdi-clipboard-text"
      title="taxes_table"
      class="px-5 py-3"
    >
      <v-btn icon fab large dark color="red" to="/taxes/form">
        <v-icon large> mdi-plus </v-icon>
      </v-btn>
      <v-simple-table>
        <thead>
          <tr>
            <th v-for="header in headers" class="primary--text">
              {{ header.text }}
            </th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="one in all">
            <td v-for="header in headers">
              {{ one[header.value] }}
            </td>
            <td>
              <v-btn icon @click="$store.dispatch('category/delete', one)">
                <v-icon small> fas fa-times </v-icon>
              </v-btn>
              <v-btn
                icon
                @click="
                  $router.push({
                    name: `${$route.name}.form`,
                    params: { item: one },
                  })
                "
              >
                <v-icon small> fas fa-edit </v-icon>
              </v-btn>
            </td>
          </tr>
        </tbody>
      </v-simple-table>
      <table-pagenation module="tax" />
      
    </base-material-card>

    <div class="py-3" />
  </v-container>
</template>
<script>
import { mapState } from "vuex";
export default {
  mounted() {
    this.$store.dispatch("tax/index");
  },
  computed: {
    ...mapState({
      all: (state) => state.tax.all,
      headers: (state) => state.tax.headers,
    }),
  },
};
</script>
