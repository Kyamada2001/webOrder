//require('./bootstrap');使うようになったらパスを通す
import Vue from 'vue'
//import VueTimepicker from 'vue2-timepicker';タイムピッカーは後でいいやとりあえずvueを使えるようにする
//import 'vue2-timepicker/dist/VueTimepicker.css';

window.Vue = require('vue').default;
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        message: 'メッセージ',
    },
    components: {
        //'vue-timepicker': VueTimepicker,
    },
});