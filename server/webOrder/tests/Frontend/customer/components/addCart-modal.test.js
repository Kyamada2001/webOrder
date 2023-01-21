/**
 * @jest-environment jsdom
 */
import { shallowMount, createLocalVue } from '@vue/test-utils'
import config from '../../../../resources/js/customer/const.js'
import addCartModal from '../../../../resources/js/customer/components/addCart-modal.vue';
import { wrap } from 'lodash';
import Vuex from 'vuex'

const localVue = createLocalVue()
localVue.use(Vuex)

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
    let laterPropData = {
        product: {
            id: 2,
            shop_id: 2,
            name: 'テスト商品2',
            price: 500,
            created_at: '2023-01-01 19:00:00',
            updated_at: '2023-01-01 19:00:00',
            imgpath: 'images/products/202204220403.jpg',
            recommenndation_flg: 0
        },
        shop: {
            id: 2,
            name: 'テスト店舗',
            business_start_time: '01:00:00',
            business_end_time: '23:30:00',
            weekly_holiday: '1,4',
            imgpath: 'images/shops/202204220403.jpg',
            created_at: '2022-04-05 23:56:38',
            updated_at: '2022-07-09 23:07:48'
        },
        modalStatus: 'add'
    };

    let order;
    let store;
    beforeEach(() => {
        order =  {
            namespaced: true,
            actions: {
              cartAction: jest.fn(),
            }
        }
        store = new Vuex.Store({
          modules: {
            order: order
          }
        })
      })

    it('methods: close', () => {
       const wrapper = shallowMount(addCartModal, {
        store,
        localVue,
        propsData: propData
       });
       wrapper.setProps(laterPropData); //propをセットしなおさないとWatch関数がよばれない

       wrapper.vm.close();

       expect(wrapper.vm.modalProduct).toBeNull();
       expect(wrapper.emitted().close).toBeTruthy();
    });

    it('methods: addCart', () => {
        const modalStatusConf = Object.values(config.MODAL_STATUS);
        modalStatusConf.forEach( (status) => {
            const wrapper = shallowMount(addCartModal, {
                store,
                localVue,
                propsData: propData
            });
            wrapper.setProps({
                product: laterPropData.product,
                shop: laterPropData.shop,
                modalStatus: status,
            });
            wrapper.vm.$nextTick(() => {
                expect(wrapper.vm.$data.modalProduct.name).toBe(laterPropData.product.name);
                const sendedModalProduct = wrapper.vm.$data.modalProduct;
                const sendedProductAffiliationShop = wrapper.vm.$data.productAffiliationShop;
                wrapper.vm.close = jest.fn();

                const button = wrapper.find('button.btn-action');
                button.trigger('click');

                switch(status){
                    case config.MODAL_STATUS.STATUS_ADD:
                        expect(button.text()).toBe('カートに追加');
                        break;
                    case config.MODAL_STATUS.STATUS_UPDATE:
                        expect(button.text()).toBe('変更する');
                        break;
                    case config.MODAL_STATUS.STATUS_DELETE:
                        expect(button.text()).toBe('削除する');
                        break;
                    default:
                        break;
                }
                expect(sendedModalProduct.modalStatus).toBe(status);
                expect(order.actions.cartAction).toHaveBeenCalledWith(expect.any(Object),{
                        productAffiliationShop: sendedProductAffiliationShop,
                        InputProduct: sendedModalProduct,
                    }
                );
                expect(wrapper.vm.close).toHaveBeenCalled();
            });
        });
    });
    it('click: btn-close', () => {
        const wrapper = shallowMount(addCartModal, {localVue, propsData: propData});
        const closeBtn = wrapper.find('button.btn-close');
        const closeBg = wrapper.find('button.btn-close');
        wrapper.vm.close = jest.fn();
        wrapper.setProps(laterPropData);

        wrapper.vm.$nextTick(() => {
            closeBtn.trigger('click');
            closeBg.trigger('click');
            expect(wrapper.vm.close).toHaveBeenCalledTimes(2);
        })
    })
})