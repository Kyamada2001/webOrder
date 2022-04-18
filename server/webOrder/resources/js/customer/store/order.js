const state = {
    cartProducts: new Array(),
}
const getters = {
    cartProducts: state => state.cartProducts ? state.cartProducts : null
}
const mutations = {
    setCartProducts(state, InputProduct){
        let existCart_flg = null;
        state.cartProducts.forEach((cartProduct,index) => {
            if(cartProduct['id'] == InputProduct.id){
                state.cartProducts[index]['modalInput'].quantity += InputProduct.modalInput.quantity;
                existCart_flg = true;
                return false;
            }
        });
        if(!existCart_flg) state.cartProducts.push(InputProduct);
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