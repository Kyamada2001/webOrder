//require('./bootstrap');使うようになったらパスを通す
import Vue from 'vue';
import VueTimepicker from 'vue2-timepicker';
import 'vue2-timepicker/dist/VueTimepicker.css';
//import Vuetify from 'vuetify';
import VueCompositionAPI from '@vue/composition-api';

window.Vue = require('vue').default;
Vue.use(VueCompositionAPI); //vueform-multiselect関係
//Vue.use(Vuetify);
//使っていないVue.component('weekly-holiday-select-component', require('./components/weekly-holiday-select.vue').default);
Vue.component('vueform-multiselect-component', require('./components/vueform-multiselect-holiday.vue').default);
Vue.component('vue-timepicker-former', require('vue2-timepicker').default);
Vue.component('vue-timepicker-complete', require('./components/vue-timepicker').default);
Vue.component('product-price-component', require('./components/product-price.vue').default);


const app = new Vue({
    el: '#app',
    //vuetify: new Vuetify(),
    /*components: {
        'vue-timepicker': VueTimepicker,
    },*/
});