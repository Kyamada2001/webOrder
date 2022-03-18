require('../bootstrap'); 

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router';
import Home from './Home.vue';
import axios from 'axios';
import store from './store';

window.Vue = Vue;
Vue.use(VueRouter);
Vue.prototype.$axios = axios;

const app = new Vue({
    el: '#app',
    router,
    store,
    components: { Home }, //最初のページだけコンポーネントを登録
    template: '<Home/>',
});