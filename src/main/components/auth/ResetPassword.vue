<template>
<v-row justify="center" dense>
    <v-col cols="6">
  <v-card outlined>
      <v-card-title>
          Reset Password
      </v-card-title>
        <v-card-text>
        <v-form class="mx-auto col-11" ref="form"  >
            <v-text-field v-model="user.email" outlined rounded dense :label="email.label" prepend-inner-icon="mdi-email" type="email"></v-text-field>
            <v-btn block color="red" @click="reset_password(user)">
                Send Reset Email
            </v-btn>
    </v-form>
        </v-card-text>
  </v-card>
  </v-col>
  </v-row>
</template>
<script>
import {mapActions} from 'vuex';
export default {
    data(){
        return{
            user:{
                email:"",
                password:""
            },
            email:{
                label:"Email"
            },
            password:{
                label:"Password"
            }
        }
    },
    methods:{
        ...mapActions(['login'])
    }
}
</script>