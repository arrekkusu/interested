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
                    <v-card class="title">
                        <v-layout column>
                            Create
                            <v-text-field 
                            placeholder="Name"
                            v-model="newInterest.title"
                                />
                                <v-textarea 
                            placeholder="What's it about?"
                            v-model="newInterest.description"
                                />
                            <v-autocomplete
                            v-model="newInterest.category_id"
                            :items="categories"
                            item-text="title"
                            item-value="id"
                            placeholder="Categories"
                            multiple 
                                />
                                <v-btn dark @click="createNew()">Create</v-btn>
                                <div class="success--text" v-show="success == true">Success!</div>
                        </v-layout>
                    </v-card>
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
            newInterest: {
                title: '',
                description: '',
                category_id: [],
            },
            categories: [],
            success: false,
        };
    },
    created() {
        this.axios.get('/interests')
        .then((response) => {
            this.interests = response.data.interests;
        });
         this.axios.get('/categories')
        .then((response) => {
            this.categories = response.data.categories;
        })
    },
    methods: {
         createNew() {
             this.axios.post('/interest/store', this.newInterest)
             .then((response) => {
                this.success = response.data.success;
                this.axios.get('/interests')
                    .then((response) => {
                        this.interests = response.data.interests;
             })
        })
         }
    }
}
</script>

<style>

</style>
