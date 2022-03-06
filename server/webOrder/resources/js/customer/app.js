//require('./bootstrap'); 使うようになったらパス通す

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router';
import Home from './views/Home.vue';

window.Vue = Vue;
Vue.use(VueRouter);


const app = new Vue({
    el: '#app',
    router,
    components: { Home } //最初のページだけコンポーネントを登録
});