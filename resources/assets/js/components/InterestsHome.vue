<template>
    <v-content>
        <v-toolbar dark>
        <v-toolbar-side-icon />
        <v-spacer></v-spacer>
        <v-toolbar-title>Interests</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
        </v-toolbar-items>
    </v-toolbar>
            <v-container grid-list-xs>
               <v-layout row wrap>
                      <v-flex xs6 d-flex v-for="(interest, i) in interests" :key="i">
                            <v-card class="ma-2" height="140" :to="'interest/profile/' + interest.id">
                                <v-img :src="interest.interest_url" alt="banner" width="100%" height="80" />
                   <div class="pa-2 title">
                    {{interest.title}}                       
                   </div>
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
            interests: [],
        };
    },
    created() {
        this.axios.get('/interests')
        .then((response) => {
            this.interests = response.data.interests;
        })
    }
}
</script>

<style>

</style>
