<template>
    <v-content>
           <v-toolbar dark>
        <v-btn flat fab class="transparent" :to="{ name: 'InterestProfile' }">
            <v-layout row wrap align-center justify-center>
                <v-icon>chevron_left</v-icon>
            </v-layout>
            </v-btn>
        <v-toolbar-title>{{conv.interest.title}} - {{conv.title}}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
        </v-toolbar-items>
    </v-toolbar>
        <v-card v-for="(mess, m) in conv.message" :key="m" class="mt-1 pa-3" :href="'/#/UserProfile/' + mess.user.id">
          <v-layout row wrap justify-start>
               <v-layout row wrap justify-start align-center>
            <v-avatar
                size="20"
                color="black"
                class="mx-3"
            >
            </v-avatar>
            <v-layout column justify-start>
            <strong>- {{mess.user.name}}</strong>
            {{mess.body}}      
            </v-layout>
            </v-layout>
            <v-layout row wrap justify-end align-center>
                {{mess.updated_at}}
            </v-layout>
          </v-layout>
        </v-card>
    <v-footer app class="px-3" width="100" height="auto">
            <v-layout row wrap justify-space-between align-center>
            <v-text-field
            @keyup.enter="submit()"
            v-model="message.body"
             />
            <v-btn dark small @click="submit()">Submit</v-btn>
            </v-layout>
    </v-footer>
    </v-content>
</template>

<script>
export default {
    data() {
        return {
            conv: {
            },
            message: {
                body: '',
                conv_id: '',
                user_id: '',
            },
            user: {
                id: '',
            },
        };
    },
    created() {
        this.axios.get(`conv/${this.$route.params.id}`)
        .then((response) => {
            this.conv = response.data.conversation;
            console.log('loaded conv');
        });
        console.log('failed to load conv');
            this.axios.get('/auth/user')
            .then((response) => {
                this.user = response.data.data;
            }) 
             this.message.user_id = this.user.id;
            this.message.conv_id = this.$route.params.id;
    },
    methods: {
        submit() {
            this.message.user_id = this.user.id;
            this.message.conv_id = this.$route.params.id;
            this.axios.post('message/store', this.message)
            .then((response) => {
                console.log('message added!');
                this.message.body = '';
        this.axios.get(`conv/${this.$route.params.id}`)
        .then((response) => {
            this.conv = response.data.conversation;
            console.log('loaded conv');
        });
            });
        }
    }
}
</script>