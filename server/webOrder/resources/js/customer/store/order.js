import axios from 'axios';

const state = {
    productAffiliationShops: new Array(),
    cartProducts: new Array(),
    orderInfo: {
        prepaid_flg: 0,
        telephoneNumber: '',
        creditNumber: '',
        order_time: {
            year: '',
            month: '',
            date: '',
            joinDate: '',
            time: '',
            dayOfWeek: '',
        }
    }
}
const getters = {
    cartProducts: state => state.cartProducts ? state.cartProducts : null
}
const mutations = {
    addCart(state, product){
        console.log(product);
        state.cartProducts.push(product);
    },
    plusCart(state, data){
        state.cartProducts[data.index]['modalInput'].quantity += data.InputProduct.modalInput.quantity;
    },
    updateCart(state, data){
        state.cartProducts[data.index]['modalInput'].quantity = data.InputProduct.modalInput.quantity;
    },
    deleteCart(state, index){
        state.cartProducts.splice(index, 1);//spliceで削除はダメらしい　https://qiita.com/sirogane/items/b9ee2f829148b5d949f7
    },
    setOrderInfo(state, orderInfo){
        state.orderInfo = orderInfo;
    },
    setProductAffiliationShops(state, shop){
        state.productAffiliationShops.push(shop);
    },
    deleteProductAffiliationShops(state, shopId){
        const deleteIndex = state.productAffiliationShops.findIndex((shop) => shop.id == shopId);
        state.productAffiliationShops.splice(deleteIndex, 1);
    },
    setOrderTime(state, dateTime){
        state.orderInfo.order_time = dateTime;// 時間と分をまとめて管理
    },
    cleanOrderInfo(state){
        state.productAffiliationShops = new Array();
        state.cartProducts = new Array();
        state.orderInfo = {
            prepaid_flg: 0,
            telephoneNumber: '',
            creditNumber: '',
            order_time: {
                year: '',
                month: '',
                date: '',
                joinDate: '',
                time: '',
                dayOfWeek: '',
            }
        };
    }
}
const actions = {
    cartAction(context, { productAffiliationShop, InputProduct }){
        let existCart_flg = null;
        if(InputProduct.modalStatus == "add" 
        && !context.state.cartProducts.some(
            value => value.shop_id === InputProduct.shop_id
        )){
            context.commit('setProductAffiliationShops', productAffiliationShop);
        }
        context.state.cartProducts.forEach((cartProduct,index) => {
            if(cartProduct['id'] == InputProduct.id) {
                if(InputProduct.modalStatus == 'add'){
                    context.commit('plusCart', { InputProduct, index });
                    existCart_flg = true;
                }
                else if(InputProduct.modalStatus == 'update') context.commit('updateCart', { InputProduct, index });
                else if(InputProduct.modalStatus == 'delete'){
                    context.commit('deleteCart', index);
                    if(!context.state.cartProducts.some(function(product){ return product.shop_id === InputProduct.shop_id })){
                        context.commit('deleteProductAffiliationShops', InputProduct.shop_id);
                    }
                }
                return false;
            }
        });
        if(InputProduct.modalStatus == 'add' && !existCart_flg) context.commit('addCart', InputProduct)
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}