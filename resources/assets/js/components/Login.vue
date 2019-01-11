<template>
   <v-content>
    <v-toolbar dark>
        <v-toolbar-side-icon dark />
            <v-spacer></v-spacer>
             <v-toolbar-title
                class="white--text"
                >
                Piccolo
            </v-toolbar-title>
            <v-spacer></v-spacer>
        <v-toolbar-items>
                <v-btn :to="{ name: 'register' }">
                    Register
                </v-btn>
              <v-btn flat :to="{ name: 'home' }">
                        Home
                    </v-btn>
        </v-toolbar-items>
    </v-toolbar>           
        <v-container grid-list-xs fluid fill-height>
            <v-layout justify-center align-center>
                 <v-flex xs10 lg12>
                   <v-layout align-center justify-center column wrap>
                    <form class="form-signin" v-on:submit.prevent="login">
                   <v-flex xs12>
                         <p class="title">Username</p>
                    <v-text-field
                    v-model="email"
                    label="E-mail"
                ></v-text-field>
                <p class="title pt-3">Password</p>
                    <v-text-field
                    v-model="password"
                    label="Password"
                    :type="show ? 'text' : 'password'"
                    :append-icon="show ? 'visibility_off' : 'visibility'"
                    @click:append="show = !show"
                ></v-text-field>
                <v-btn color="primary" type="submit">Continue</v-btn>     
                   </v-flex>           
                   </form>
                   </v-layout>
               </v-flex>
               </v-layout>
        </v-container>
    </v-content>
</template>

<script>
import store from '../store'

export default {
     data(){
      return {
        email: null,
        password: null,
        error: false,
        show: false,
        loginError: false,
      }
    },
    methods: {
      login(){  
          this.loginError = false
        this.axios.post('api/auth/login', {
            email: this.email,
            password: this.password
        })
        .then((response) => {
           store.commit('loginUser')
                    localStorage.setItem('token', response.data.access_token)
                    this.$router.push({ name: 'dashboard' })
                }).catch(error => {
                    this.loginError = true
                });
      },
    }
}
</script>

<style>

</style>
