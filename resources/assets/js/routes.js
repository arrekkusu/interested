import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import Dashboard from './components/Dashboard.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import UserProfile from './components/UserProfile.vue';
import InterestsHome from './components/InterestsHome.vue';
import InterestProfile from './components/InterestProfile.vue';
import Conversation from './components/Conversation.vue';
import Messages from './components/Messages.vue';

Vue.use(VueRouter)

const routes = [
    {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
        auth: false
    }
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
        requiresAuth: true
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
},{
    path: '/user/messages',
    name: 'Messages',
    component: Messages,
    meta: {
        auth: true
    }
}
]

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'login' })
        return
    }

    // if logged in redirect to dashboard
    if(to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'dashboard' })
        return
    }

    next()
})

export default router