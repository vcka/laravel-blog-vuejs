import Vue from 'vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

Vue.use(require('vue-moment'));

import App from './components/App.vue';
import Post from './components/Post.vue';
import PostDetails from './components/PostDetail.vue';
import SideBar from './components/SideBar.vue';
import Register from './components/register.vue';
import Login from './components/Login.vue';
import Profile from './components/Profile.vue';
import store from './store/store';

Vue.use(store);

import common from './helpers/common';
import userHelper from './helpers/user';

const helpers = {
    install(Vue, options) {
        Vue.prototype.$commonHelper = common;
        Vue.prototype.$userHelper = userHelper;
    }
};

Vue.use(helpers);

import FBSignInButton from 'vue-facebook-signin-button';
Vue.use(FBSignInButton);

import GSignInButton from 'vue-google-signin-button';
Vue.use(GSignInButton);

const routes = [
    {path: '/', name: 'home', component: Post},
    {path: '/register', name: 'register', component: Register},
    {path: '/login', name: 'login', component: Login},
    {path: '/profile', name: 'profile', component: Profile},
    {path: '/post/:slug', name: 'post_details', component: PostDetails},
    {path: '/post/category/:category', name: 'post_category', component: Post},
    {path: '/post/tag/:tag', name: 'post_tag', component: Post},
    {path: '/archive/:year', name: 'archive_year', component: Post},
    {path: '/archive/:year/:month', name: 'archive_month', component: Post}
];

const router = new VueRouter({mode: 'history', routes: routes});


new Vue(Vue.util.extend({router, store}, App)).$mount('#app');