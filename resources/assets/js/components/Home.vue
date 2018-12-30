<template>
    <v-content>
           <v-toolbar dark>
               <v-toolbar-side-icon />
               <v-spacer></v-spacer>
               <v-toolbar-title class="title white--text">
                   Welcome
               </v-toolbar-title>
               <v-spacer></v-spacer>
               <v-toolbar-items>
                     <v-btn class="transparent" flat>
                        <router-link class="white--text" :to="{ name: 'home' }">Home</router-link>
                    </v-btn>
                    <v-btn flat v-if="!$auth.check()" class="pull-right transparent">
                        <router-link class="white--text" :to="{ name: 'login' }">Login</router-link>
                    </v-btn>
                    <v-btn flat v-if="!$auth.check()" class="pull-right transparent">
                        <router-link class="white--text" :to="{ name: 'register' }">Register</router-link>
                    </v-btn>
                    <v-btn flat v-if="$auth.check()" class="white--text transparent" @click.prevent="$auth.logout()">
                        Logout
                    </v-btn>
               </v-toolbar-items>
           </v-toolbar>
    </v-content>
</template>

<script>
export default {

}
</script>

<style>

</style>
