<template>
    <v-content>
         <v-toolbar dark>
        <v-btn flat fab class="transparent" :to="{ name: 'InterestsHome' }">
            <v-layout row wrap align-center justify-center>
                <v-icon>chevron_left</v-icon>
            </v-layout>
            </v-btn>
        <v-toolbar-title>{{interest.title}}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
            {{int}}
        </v-toolbar-items>
    </v-toolbar>
        <v-img 
        height="150"
        :src="interest.interest_url"
        />
        <v-card class="subheading pa-3">
            <v-layout column>
                            <strong>Description - </strong>
            {{interest.description}}
            </v-layout>
<v-layout row wrap justify-end>
            <v-btn class="mt-3" v-show="subscribed == false" dark @click="subscribe()">Subscribe</v-btn>    
            <v-btn class="mt-3 grey-lighten_3" v-show="subscribed == true" dark @click="unsubscribe()">Unsubscribe</v-btn>    
</v-layout>
        </v-card>
        <v-card class="mt-1 pa-3" dark>
            <v-layout row wrap align-center class="px-3">
                <v-flex xs8>
                    Start a new topic? (Please check current topics before adding a new one)
                </v-flex>
                <v-layout row wrap justify-end>
                   <v-btn @click="createNew = !createNew">Create New</v-btn>                    
                </v-layout>
            </v-layout>
        </v-card>
        <v-card v-for="(conversation, c) in interest.conversation" :key="c" class="mt-1 pa-3">
            <v-layout row wrap class="pl-3">
                <v-flex xs9>
                {{conversation.title}}
                </v-flex>
                <v-flex xs3>
                    <v-layout row wrap justify-end class="px-3">
                        <a :href="`/#/conv/${conversation.id}`">
                        <v-btn dark small>Join Conversation</v-btn>                                                            
                        </a>
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-card>
        <div class="text-xs-center">
        <v-dialog
            v-model="createNew"
            max-width="500px"
            transition="dialog-transition"
        >
        <v-card class="pa-3 title" height="auto">
            <v-layout column>
                <v-flex xs12>
                     Start a New Conversation
                <v-text-field
                v-model="conv.title"
                placeholder="Start a new conversation?"
                @keyup.enter="newConv()"
                 />
                 <v-btn @click="newConv()" dark>Create</v-btn>
                </v-flex>
            </v-layout>
        </v-card>
        </v-dialog>
        <v-dialog
            v-model="loading" 
            persistent
            max-width="500px"
            transition="dialog-transition"
        >
            <v-card class="pa-3">
                Loading...
            </v-card>
        </v-dialog>
    </div>
    </v-content>
</template>

<script>
export default {
    data() {
        return {
            user: {
                id: '',
            },
            interest: {
                id: '',
                title: '',
                conversation: [],
            },
            createNew: false,
            loading: false,
            conv: {
                title: '',
                id: '',
            },
            subscribed: false,
            int: '',
            intitle: '',
        };
    },
    created() {
        // this.loading = true;
        this.axios.get(`interest/profile/${this.$route.params.id}`)
        .then((response) => {
            this.interest = response.data.interest;
        });
        this.axios.get('auth/user')
        .then((response) => {
            this.user = response.data.data;
            console.log(this.user);
        this.intitle = this.interest.title;
        });
        this.int = this.user.interest.includes(item => item.title.toLowerCase() === this.interest.title.toLowerCase());
        // if ( this.int == true) {
        //     this.subscribed = true;
        // } else {
        //     this.subscribed = false;
        // };
        this.loading = false;
    },
    methods: {
        newConv() {
            this.conv.id = this.$route.params.id;
            this.axios.post('conv/store', this.conv)
            .then((response) => {
                console.log('created!');
                this.title = ''
                this.createNew = false;
                 this.axios.get(`interest/profile/${this.$route.params.id}`)
        .then((response) => {
            this.interest = response.data.interest;
        });
            })
        },
        subscribe() {
            this.axios.post(`subscribe/${this.$route.params.id}/${this.user.id}/add`)
            .then((response) => {
                this.subscribed = response.data.subscribed;
                console.log(response.data);
            });
        },
        unsubscribe() {
        this.axios.post(`subscribe/${this.$route.params.id}/${this.user.id}/remove`)
        .then((response) => {
            this.subscribed = response.data.subscribed;
            });
        },
    }
}
</script>