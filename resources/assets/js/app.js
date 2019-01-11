import Vue from 'vue';
import VueX from 'vuex';
import Vuetify from 'vuetify';
import router from './routes.js';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import colors from 'vuetify/es5/util/colors';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Vue2Filters from 'vue2-filters';
import App from './App.vue';

Vue.use(VueRouter);
Vue.use(Vue2Filters);
Vue.use(VueX);
Vue.use(Vuetify);
Vue.use(VueAxios, axios);
Vue.use(Vuetify, {
    theme: {
      primary: colors.red.darken2,
      secondary: colors.red.darken4,
      accent: colors.teal.base},
  });
// axios.defaults.baseURL = 'http://phplaravel-232735-711542.cloudwaysapps.com/api';

const app = new Vue({
  components: {
      App
  },
  router
}).$mount('#app');
// Vue.use(require('@websanova/vue-auth'), {
//    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
//    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
//    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
// });
// new Vue(App)