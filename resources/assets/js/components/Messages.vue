<template>
    <v-content>
          <v-toolbar dark>
        <v-toolbar-side-icon dark @click.stop="sidenav = !sidenav" />
        <v-spacer></v-spacer>
            <v-toolbar-title
            class="white--text">
            Messages
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
                 <v-btn flat v-if="$auth.check()" class="white--text transparent" @click.prevent="$auth.logout()">
                        Logout
                    </v-btn>
        </v-toolbar-items>
    </v-toolbar>
        <v-stepper v-model="step">
            <v-stepper-content step="1">
                <v-card v-for="(thread, t) in 3" :key="t" class="my-1 pa-3" @click="toMessages()">
                    message {{t + 1}}
                </v-card>
            </v-stepper-content>
             <v-stepper-content step="2">
                 <v-card>
                     
                 </v-card>

            </v-stepper-content>
        </v-stepper>
    </v-content>
</template>

<script>
export default {
    data() {
        return {
            sidenav: false,
            step: 1,
        }
    },
    maounted() {
        this.axios.get('auth/user')
        .then((response) => {
            this.user = response.data.data;
        });
    },
    methods: {
        toMessages() {
            this.step == 2; 
            // this.conv.id = this.thread.id;
        }
    }
}
</script>

<style>

</style>
