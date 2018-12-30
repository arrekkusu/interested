import Vue from 'vue';
import Vuetify from 'vuetify';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import colors from 'vuetify/es5/util/colors';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import Dashboard from './components/Dashboard.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import UserProfile from './components/UserProfile.vue';
import InterestsHome from './components/InterestsHome.vue';
import InterestProfile from './components/InterestProfile.vue';
import Conversation from './components/Conversation.vue';

Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(VueAxios, axios);
Vue.use(Vuetify, {
    theme: {
      primary: colors.red.darken2,
      secondary: colors.red.darken4,
      accent: colors.teal.base},
  });
axios.defaults.baseURL = 'http://localhost:8000/api';
const router = new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        component: Home
    },{
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },{
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },{
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },{
        path: '/UserProfile/:id',
        name: 'userprofile',
        component: UserProfile,
        meta: {
            auth: true
        }
    },{
        path: '/interests',
        name: 'InterestsHome',
        component: InterestsHome,
    },{
        path: '/interest/profile/:id',
        name: 'InterestProfile',
        component: InterestProfile,
    },{
        path: '/conv/:id',
        name: 'Conversation',
        component: Conversation,
        meta: {
            auth: true
        }
    }
]
});
Vue.router = router
Vue.use(require('@websanova/vue-auth'), {
   auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
   http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
   router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});
App.router = Vue.router
new Vue(App).$mount('#app');