<template>
<v-content class="pa-0" width="100%">
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
      <v-toolbar color="primary">
          <v-toolbar-side-icon @click="sidenav = !sidenav" />
            <v-toolbar-title>
                Your Profile
                </v-toolbar-title>
        </v-toolbar>
        <v-flex xs12>
            <v-card class="secondary" width="100%" height="200">
            <v-layout row wrap justify-center>
                 <v-avatar
                 class="mt-3"
                size="300"
                color="primary"
            >
                <!-- <img src="src" alt="alt"> -->
            </v-avatar>
            <div class="title py-3">
                Welcome {{user.name}}
            </div>
            </v-layout>
            <v-tabs class="title">
                <v-tab>
                    Interests
                </v-tab>
                  <v-tab>
                    About You
                </v-tab>
                  <v-tab>
                    
                </v-tab>
                <v-tab-item>
                    <v-layout row wrap justify-center>
                        <v-card width="100%" class="pa-2 mb-3 title">
                            <v-flex xs12>
                                <v-layout column>
                                Find New Interests
                                <v-btn color="primary">Find New</v-btn>                                    
                                </v-layout>
                            </v-flex>
                        </v-card>
                        <div v-for="(interests, i) in user.interests" :key="i">
                        <v-card width="190" height="190">
                            {{interests.interests.name}}
                        </v-card>
                        </div>
                    </v-layout>
                </v-tab-item>
                <v-tab-item>                    
                </v-tab-item>
            </v-tabs>
        </v-card>
        </v-flex>
</v-content>
</template>

<script>
export default {
    data() {
        return {
            user: {

            },
            sidenav: false,
        };
    },
    mounted() {
        axios.get('/auth/user')
            .then((response) => {
                this.user = response.data.user;
            }) 
    }
}
</script>

