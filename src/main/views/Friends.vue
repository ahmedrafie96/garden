<template>
  <v-container>
    <v-card color="#f9ffff">
      <v-card-title
        style="background: #e9ffdb"
        class="text-center elevation-5"
        v-ripple="{ center: true }"
      >
        <v-spacer></v-spacer>
        <span class="headline"> ----<strong> Our Friends </strong> ----</span>
        <v-spacer></v-spacer>
      </v-card-title>
      <v-container>
        <v-card-text>
          <v-item-group>
            <v-container>
              <v-row>
                <v-col
                  v-for="friend in friends"
                  :key="friend.id"
                  cols="12"
                  md="4"
                >
                  <v-item>
                    <v-card
                      flat
                      :color="active ? 'primary' : ''"
                      height="300"
                      @click="toggle"
                    >
                      <v-card-title>
                        <v-spacer></v-spacer>
                        <v-avatar
                          class="mt-8"
                          width="120"
                          height="120"
                          color="indigo"
                        >
                          <img
                            :src="friend.image_url"
                            alt=""
                            width="120"
                            height="120"
                          />
                        </v-avatar>
                        <v-spacer></v-spacer>
                      </v-card-title>
                      <v-card-text>
                        <v-row class="mt-2" justify="center">
                          <p>
                            <strong> {{ friend.name }}</strong>
                          </p>
                        </v-row>
                        <v-row class="mt-3" justify="center">
                          <p>{{ friend.content }}</p>
                        </v-row>
                      </v-card-text>
                    </v-card>
                  </v-item>
                </v-col>
              </v-row>
            </v-container>
          </v-item-group>
        </v-card-text>
      </v-container>
    </v-card>
  </v-container>
</template>

<script>
import { mapState } from "vuex";
export default {
  mounted() {
    this.$store.dispatch("friend/index");
    window.scrollTo(0,0);
  },
  computed: {
    ...mapState({
      friends: (state) => state.friend.all,
    }),
  },
};
</script>

<style>
</style>