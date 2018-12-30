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
                    :type="show1 ? 'text' : 'password'"
                    :append-icon="show1 ? 'visibility_off' : 'visibility'"
                    @click:append="show1 = !show1"
                ></v-text-field>
                <v-btn color="primary" @click="login()">Continue</v-btn>     
                   </v-flex>           
                   </v-layout>
               </v-flex>
               </v-layout>
        </v-container>
    </v-content>
</template>

<script>
export default {
     data(){
      return {
        email: null,
        password: null,
        error: false,
        show1: false,
      }
    },
    methods: {
      login(){
        var app = this
        this.$auth.login({
            params: {
              email: app.email,
              password: app.password
            }, 
            success: function () {},
            error: function () {},
            rememberMe: true,
            redirect: '/dashboard',
            fetchUser: true,
        });       
      },
    }
}
</script>

<style>

</style>
