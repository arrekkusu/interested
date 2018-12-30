<template>
          <v-content>
        <v-toolbar dark>
        <v-toolbar-side-icon dark @click.stop="sidenav = !sidenav" />
        <v-spacer></v-spacer>
            <v-toolbar-title
            class="white--text">
            Dashboard
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
                 <v-btn flat v-if="$auth.check()" class="white--text transparent" @click.prevent="$auth.logout()">
                        Logout
                    </v-btn>
        </v-toolbar-items>
        
    </v-toolbar>
    <v-navigation-drawer
        v-model="sidenav"
        absolute
        temporary
      >
        <v-list class="pa-1">
          <v-card flat class="pa-2">
              <v-layout row wrap align-center>
                  <v-flex xs5>
                       <v-avatar
                       size="50"
                       color="primary"
                   >
                   <img src="https://randomuser.me/api/portraits/men/85.jpg">
                   </v-avatar>
                  </v-flex>
                  <v-flex xs7>
                           <v-layout column justify-start>
                    {{user.name}}
                    {{user.email}}        
                  </v-layout>
                  </v-flex>           
              </v-layout>
             
          </v-card>
        </v-list>
  
        <v-list class="pt-0" dense>
          <v-divider></v-divider>
          <v-list-group>
        <v-list-tile slot="activator" class="primary--text">
            <v-list-tile-action class="primary--text"><v-icon>account_circle</v-icon></v-list-tile-action>
            <v-list-tile-title>Account</v-list-tile-title>
        </v-list-tile>
        <v-divider></v-divider>
        <v-list-tile :to="`/userprofile/` + user.id" class="grey" dark>
            <v-list-tile-action>
                <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-title dark>Profile</v-list-tile-title>
        </v-list-tile>
         <v-list-tile @click="$auth.logout()">
            <v-list-tile-action>
                <v-icon>quit_app</v-icon>
            </v-list-tile-action>
            <v-list-tile-title dark>Sign out</v-list-tile-title>
        </v-list-tile>
        </v-list-group>
          <v-list-tile
            to="/interests"
          >
            <v-list-tile-action>
              <v-icon>dashboard</v-icon>
            </v-list-tile-action>
  
            <v-list-tile-content>
              <v-list-tile-title>Interests</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-navigation-drawer>
    <v-container grid-list-xs fluid fill-height width="100%">
       <v-layout row wrap justify-center align-center>
            <v-flex xs12 md4>
            <v-card>
                <v-card color="primary pa-3" dark>
                <v-layout row wrap justify-space-between>
                    <p class="title pt-3">Nofifications</p>
                    <v-avatar color="secondary"></v-avatar>
                </v-layout>
                </v-card>
                <v-card class="pa-3">
                    <v-layout row wrap>
                        <v-flex md9 xs9>
                            *message*
                        </v-flex>
                        <v-flex md3 xs3>
                            <v-avatar color="secondary"></v-avatar>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-card>              
            </v-flex>
            <v-flex xs12 md4>
            <v-card>
                <v-card color="primary pa-3" dark>
                <v-layout row wrap justify-space-between>
                    <p class="title pt-3">Nofifications</p>
                    <v-avatar color="secondary"></v-avatar>
                </v-layout>
                </v-card>
                <v-card class="pa-3">                    
                </v-card>
            </v-card>              
            </v-flex>
       </v-layout>
    </v-container>
   </v-content>
</template>

<script>
export default {
        data() {
           return {
              sidenav: false,
              user: [],
           };
        },
        mounted() {
                this.axios.get('auth/user')
                .then((response) => {
                        this.user = response.data.data;
                });
        }
}
</script>

<style>

</style>
