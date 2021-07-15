<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component heading="gardners" />
    
    <base-material-card
      icon="mdi-clipboard-text"
      :title="$t('gardners_table')"
      class="px-5 py-3"
    >
    <v-btn icon fab large dark color="red" to="/gardners/form">
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
              <v-btn icon @click="$store.dispatch('gardner/delete',one)">
                <v-icon small>
                  fas fa-times
                </v-icon>
              </v-btn>
              <v-btn icon @click="$router.push({name:`${$route.name}.form`,params:{item:one}})">
                <v-icon small>
                  fas fa-edit
                </v-icon>
              </v-btn>
            </td>
          </tr>
        </tbody>
      </v-simple-table>
      <table-pagenation module="gardner" />

    </base-material-card>

    <div class="py-3" />

  </v-container>
</template>
<script>
import { mapState } from "vuex";
export default {
  mounted() {
    this.$store.dispatch("gardner/index");
  },
  computed: {
    ...mapState({
      all: (state) => state.gardner.all,
      headers: (state) => state.gardner.headers,
    }),
  },
};
</script>
