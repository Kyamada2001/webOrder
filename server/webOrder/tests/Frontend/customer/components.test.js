/**
 * @jest-environment jsdom
 */
// エラー発生する
import { shallowMount, createLocalVue } from '@vue/test-utils'

import addCartModal from '@../../../resources/js/customer/components/addCart-modal.vue';

describe('addCartModal', () => {

    let propData = {
        product: {
            id: 1,
            shop_id: 1,
            name: 'テスト商品1',
            price: 1000,
            created_at: '2023-01-01 19:00:00',
            updated_at: '2023-01-01 19:00:00',
            imgpath: 'images/products/202204220403.jpg',
            recommenndation_flg: 0
        },
        shop: {
            id: 1,
            name: 'テスト店舗',
            business_start_time: '01:00:00',
            business_end_time: '23:30:00',
            weekly_holiday: '1,4',
            imgpath: 'images/shops/202204220403.jpg',
            created_at: '2022-04-05 23:56:38',
            updated_at: '2022-07-09 23:07:48'
        },
        modalStatus: 'add',
    };

    it('methods: close', () => {
        console.log(propData);
       const wrapper = shallowMount(addCartModal, {
        propsData: propData
       });
       wrapper.setProps({ // propsを再設定しないとwatch関数がよばれない
        product: {
            id: 2,
            shop_id: 1,
            name: 'テスト商品2',
            price: 500,
            created_at: '2023-01-01 19:00:00',
            updated_at: '2023-01-01 19:00:00',
            imgpath: 'images/products/202204220403.jpg',
            recommenndation_flg: 0
        }
       });

       wrapper.vm.close();

       expect(wrapper.vm.modalProduct).toBeNull();
       expect(wrapper.emitted().close).toBeTruthy()
    });

    it('methods: addCart', () => {
        expect();
    });


})