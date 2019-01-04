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
            <v-btn fab @click="searchDialog = !searchDialog"><v-icon dark>search</v-icon></v-btn>
          
           <v-flex xs11 md8 lg6>
           <v-dialog
               v-model="searchDialog"
               scrollable 
               :overlay="false"
               max-width="500px"
               transition="dialog-transition"
           >
                <v-card class="pa-3">
                  <v-autocomplete
            v-model="searchUser"
            :items="users"
            item-text="name"
            item-value="name"
            preppend:icon="search"
             /> 
           </v-card>
           </v-dialog>
           </v-flex>
                 <v-btn fab flat v-if="$auth.check()" class="white--text transparent" @click.prevent="$auth.logout()">
                        <v-icon>exit_to_app</v-icon>
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
                <v-icon>exit_app</v-icon>
            </v-list-tile-action>
            <v-list-tile-title dark>Sign out</v-list-tile-title>
        </v-list-tile>
        </v-list-group>
        <v-list-group
        >
          <v-list-tile
            slot="activator"
          >
            <v-list-tile-action>
              <v-icon>dashboard</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Interests</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile :to="'interests'">
              <v-list-tile-action>
                  <v-icon></v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                  See All
              </v-list-tile-content>
          </v-list-tile>
          <v-list-tile v-for="(topInterests, t) in user.interest" :key="t" v-if="user.interest && user.interest.length > 0 && t <= limitationList" :to="'interest/profile/' + topInterests.id">
              <v-list-tile-action>
                    {{topInterests.title}}
                  </v-list-tile-action>
          </v-list-tile>
          <v-list-tile @click="limitationList = limitationList + 4" dark>
              <v-list-tile-action>
                  <v-icon>add</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                  More...
              </v-list-tile-content>
          </v-list-tile>
        </v-list-group>
        <v-list-tile to="user/messages">
            <v-list-tile-action>
                <v-icon>message</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                Messages
            </v-list-tile-content>
        </v-list-tile>
        </v-list>
      </v-navigation-drawer>
    <v-container grid-list-xs fluid fill-height width="100%">
       <v-layout row wrap justify-center align-center>
            <v-flex xs12 md4>
            <v-card>
                <v-card color="pa-3" dark>
                <v-layout row wrap justify-space-between>
                    <p class="title">Reccommended</p>
                </v-layout>
                </v-card>
                <v-card class="pa-3 mb-1" v-for="(recommend, z) in recommended" :key="z" :to="'interest/profile/' + recommend.id">
                    <v-layout row wrap>
                        <v-flex md9 xs9>
                            {{recommend.title}}
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
              recommended: [],
              limitationList: 4,
              users: [],
              searchUser: '',
              searchDialog: false,
           };
        },
        mounted() {
                this.axios.get('auth/user')
                .then((response) => {
                        this.user = response.data.data;
                         this.axios.get(`${this.user.id}/recommended`)
                .then((response) => {
                    this.recommended = response.data.recommended;
                })
                });
                this.axios.get('get/users')
                .then((response) => {
                    this.users = response.data.users;
                });
        },
        methods: {
            search() {
                this.axios.get(`user/${searchUser}/search`)
                .then((response) => {
                    this.success = response.data.success;
                })
            }
        }
}
</script>

<style>

</style>
