// const { testing } = require('laravel-mix/src/Log');
// const sum = require('./sum');

// import Sum from '../sum.js';

// describe('QuizFetcherのテスト', () => {
//     it('クラスチェック', () => {
//       console.log('@@@@@@');
//     });
// });

// エラー発生する
// import { shallowMount, createLocalVue } from '@vue/test-utils'
// import Vuex from 'vuex'
// import CounterVuex from '@/components/CounterVuex'
// import { iteratee } from 'lodash';

import addCartModal from '@../../../resources/js/customer/components/addCart-modal.vue';
// import addCartModal from '../../../resources/js/customer/components/;

describe('addCartModal', () => {

    it('methods: close', () => {
       const wrapper = shallowMount(addCartModal);

       wrapper.vm.close();

       expect(wrapper.vm.modalStatus).toBeNull();
       expect(wrapper.emitted().close).toBeTruthy()
    });

    it('methods: addCart', () => {

    })


})