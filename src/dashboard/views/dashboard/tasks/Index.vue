<template>
  <v-container id="regular-tables" fluid tag="section">
    <base-v-component heading="tasks" />

    <base-material-card
      icon="mdi-clipboard-text"
      title="tasks_table"
      class="px-5 py-3"
    >
      <v-btn icon fab large dark color="red" to="/tasks/form">
        <v-icon large> mdi-plus </v-icon>
      </v-btn>
      <v-simple-table>
        <thead>
          <tr>
            <th v-for="header in headers" class="primary--text">
              {{ header.text }}
            </th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="one in all">
            <td v-for="header in headers">
              {{ one[header.value] }}
            </td>
            <td>
              <v-btn
                v-if="$store.state.auth.user.type == 'gardner'"
                icon
                @click="
                  one.status = 'done';
                  update(one);
                "
              >
                <v-icon>mdi-check</v-icon>
              </v-btn>
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
      <table-pagenation module="task" />

    </base-material-card>

    <div class="py-3" />
  </v-container>
</template>
<script>
import { mapActions, mapState } from "vuex";
export default {
  mounted() {
    this.$store.dispatch("task/index");
  },
  computed: {
    ...mapState({
      all: (state) => state.task.all,
      headers: (state) => state.task.headers,
    }),
  },
  methods: {
    ...mapActions("task", ["update"]),
  },
};
</script>
