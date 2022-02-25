//require('./bootstrap');使うようになったらパスを通す
import Vue from 'vue';
import VueTimepicker from 'vue2-timepicker';
import 'vue2-timepicker/dist/VueTimepicker.css';
import Vuetify from 'vuetify';

window.Vue = require('vue').default;
Vue.use(Vuetify);
Vue.component('weekly-holiday-select-component', require('./components/weekly-holiday-select.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    components: {
        'vue-timepicker': VueTimepicker,
        //'ButtonComponent': App,
    },
});