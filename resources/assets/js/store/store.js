import Vue from 'vue';
import Vuex from 'Vuex';
Vue.use(Vuex);

import userStore from './user/userStore';

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    modules: {userStore},
    strict: debug
});
