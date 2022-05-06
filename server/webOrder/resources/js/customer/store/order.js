import axios from 'axios';

const state = {
    productAffiliationShops: new Array(),
    cartProducts: new Array(),
    orderInfo: {
        prepaid_flg: 0,
        telephoneNumber: '',
        creditNumber: '',
    }
}
const getters = {
    cartProducts: state => state.cartProducts ? state.cartProducts : null
}
const mutations = {
    addCart(state, product){
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
        console.log('deleteShop')
        console.log(state.productAffiliationShops)
        const deleteIndex = state.productAffiliationShops.findIndex((shop) => {
            shop.id == shopId;
        });
        state.productAffiliationShops.splice(deleteIndex, 1);
    }
}
const actions = {
    cartAction(context, { productAffiliationShop, InputProduct }){
        let existCart_flg = null;
        if(InputProduct.modalStatus == "add" && !context.state.cartProducts.some(
            value => value.shop_id === InputProduct.shop_id
        )){
            console.log('所属店舗作成前1')
            console.log(context.state.productAffiliationShops);
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
                    if(context.state.cartProducts.some(product => { product.shop_id === InputProduct.shop_id })){
                        console.log('削除している')
                        context.commit('deleteProductAffiliationShops', InputProduct.shop_id);
                    }
                    console.log('所属店舗')
                    console.log(context.state.productAffiliationShops);
                }
                return false;
            }
        });
        if(InputProduct.modalStatus == 'add' && !existCart_flg) context.commit('addCart', InputProduct)
    },
    order(context){
        let response = axios.post('/api/order', {
            cartProducts: context.state.cartProducts,
            orderInfo: context.state.orderInfo,
            customer: context.rootState.auth.customer,
        }).catch(err => err.response || err);
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}