const state = {
    cartProducts: new Array(),
}
const getters = {
    cartProducts: state => state.cartProducts ? state.cartProducts : null
}
const mutations = {
    setCartProducts(state, InputProduct){ //actionに移動
        if(InputProduct.modalStatus == 'add'){
            let existCart_flg = null;
            state.cartProducts.forEach((cartProduct,index) => {
                if(cartProduct['id'] == InputProduct.id){
                    state.cartProducts[index]['modalInput'].quantity += InputProduct.modalInput.quantity;
                    existCart_flg = true;
                    return false;
                }
            });
            if(!existCart_flg) state.cartProducts.push(InputProduct);
        }else if(InputProduct.modalStatus == 'update'){
            state.cartProducts.forEach((cartProduct,index) => {
                if(cartProduct['id'] == InputProduct.id) {
                    state.cartProducts[index]['modalInput'].quantity = InputProduct.modalInput.quantity;
                    return false;
                }
            });
        }else if(InputProduct.modalStatus == 'delete'){
            state.cartProducts.forEach((cartProduct,index) => {
                if(cartProduct['id'] == InputProduct.id) {
                    state.cartProducts.splice(index, 1);
                    return false;
                }
            });
        }
    }
}
const actions = {

}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}