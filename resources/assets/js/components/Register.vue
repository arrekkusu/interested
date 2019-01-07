<template>
 <v-content>
    <v-toolbar color="primary">
        <v-layout row wrap justify-center>
             <v-toolbar-title
                class="white--text"
                >
                Sign Up
            </v-toolbar-title>
        </v-layout>   
    </v-toolbar>            
        <v-container grid-list-xs fluid fill-height>
        <v-layout justify-center align-center>
                 <v-flex xs10 lg12>
                   <v-layout align-center justify-center column wrap>
                       <v-flex xs12>
                            <v-text-field
                    v-model="username"
                    label="Username"
                    required
                    />
                    <v-text-field
                    v-model="name"
                    label="Name"
                    id="2"
                    required
                    />
                    <v-text-field
                    v-model="email"
                    label="E-Mail"
                    required
                    />
                    <v-text-field
                    v-model="password"
                    label="Password"
                    :type="show1 ? 'text' : 'password'"
                    :append-icon="show ? 'visibility_off' : 'visibility'"
                    @click:append="show = !show"
                ></v-text-field>
                  <v-btn width="100%" @click="register()" color="primary">Submit</v-btn>
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
                username: '',
                name: '',
                email: '',
                password: '',
                error: false,
                errors: {},
                success: false,
                show: false,
            };
        },
        methods: {
            register(){
                var app = this
                this.$auth.register({
                    data: {
                        username: app.username,
                        name: app.name,
                        email: app.email,
                        password: app.password
                    }, 
                    success: function () {
                        app.success = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: 'dashboard'
                });                
            }
        }
}
</script>

<style>

</style>
