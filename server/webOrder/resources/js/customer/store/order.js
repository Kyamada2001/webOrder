const state = {
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
        state.cartProducts.splice(index, 1);
    },
    setOrderInfo(state, orderInfo){
        state.orderInfo = orderInfo;
    },
}
const actions = {
    cartAction(context, InputProduct){
        let existCart_flg = null;
        context.state.cartProducts.forEach((cartProduct,index) => {
            if(cartProduct['id'] == InputProduct.id) {
                if(InputProduct.modalStatus == 'add'){
                    context.commit('plusCart', { InputProduct, index });
                    existCart_flg = true;
                }
                else if(InputProduct.modalStatus == 'update') context.commit('updateCart', { InputProduct, index });
                else if(InputProduct.modalStatus == 'delete') context.commit('deleteCart', index);
            }
            return false;
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