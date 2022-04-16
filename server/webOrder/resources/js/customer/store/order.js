const state = {
    cartProducts: new Array(),
}
const getters = {
    cartProducts: state => state.cartProducts ? state.cartProducts : null
}
const mutations = {
    setCartProducts(state, cartProduct){
        state.cartProducts.push(cartProduct);
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