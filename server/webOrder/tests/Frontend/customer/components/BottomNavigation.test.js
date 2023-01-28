/**
 * @jest-environment jsdom
 */
import { shallowMount, createLocalVue, RouterLinkStub } from '@vue/test-utils';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
//  import auth from '../../../../resources/js/customer/store/auth';
//  import order from '../../../../resources/js/customer/store/order';
import store from '../../../../resources/js/customer/store/index';
import BottomNavigation from '../../../../resources/js/customer/components/BottomNavigation.vue';
 
const localVue = createLocalVue();
localVue.use(Vuex);
localVue.use(VueRouter);

describe('BottomNavigation', () => {
    // let store;
    let product;
    let customer;
    let router;
    let links;
    beforeEach(() => {
        product = {
            id: 2,
            shop_id: 2,
            name: 'テスト商品2',
            price: 500,
            created_at: '2023-01-01 19:00:00',
            updated_at: '2023-01-01 19:00:00',
            imgpath: 'images/products/202204220403.jpg',
            recommenndation_flg: 0,
            modalInput: {
                quantity: 1
            }
        };
        customer = {
            username: 'テストユーザー',
            password: '$2y$10$Mh9mnspQgNyDGPaUiKJVg./tzAklkPHUcdk5dKnAuWCd74w0vPa.C',
            created_at: '2022-03-28 13:03:23',
            updated_at: '2022-03-28 13:03:23',
            email: 'test1@example.com',
            email_verified_at: null
        };
        router = new VueRouter({ routes: [] });

    });
    it('computed "isLogin = false", change router-link path', () => {
        //未ログイン
        const wrapper = shallowMount(BottomNavigation, {
            localVue,
            store,
            router
        });
        links = wrapper.findAll('router-link-stub');
        expect(wrapper.vm.isLogin).toEqual(false);
        expect(links.at(0).props().to).toBe('/');
        expect(links.at(1).props().to).toBe('/shops');
        expect(links.at(2).props().to).toBe( '/products');
        expect(links.at(3).props().to).toBe('/order/cart');
        expect(links.at(4).props().to).toBe('/member/select-login');
    });
    it('computed "isLogin = true", change router-link path', () => {
        //ログイン
        store.commit('auth/setCustomer', customer);
        const wrapper = shallowMount(BottomNavigation, {
            localVue,
            store,
            router
        });
        links = wrapper.findAll('router-link-stub');
        expect(wrapper.vm.isLogin).toEqual(true);
        expect(links.at(0).props().to).toBe('/');
        expect(links.at(1).props().to).toBe('/shops');
        expect(links.at(2).props().to).toBe('/products');
        expect(links.at(3).props().to).toBe('/order/cart');
        expect(links.at(4).props().to).toBe('/order/histories');
    })
    it('update navigation-cart-menu-quantiy', () => {
        const wrapper = shallowMount(BottomNavigation, {
            localVue,
            store,
            router
        });
        expect(wrapper.vm.quantity).toBe(0);
        wrapper.vm.$store.state.order.cartProducts.push(product);
        expect(wrapper.vm.quantity).toBe(1);
        wrapper.vm.$store.state.order.cartProducts.splice(0, 1);
        expect(wrapper.vm.quantity).toBe(0);
    })
});