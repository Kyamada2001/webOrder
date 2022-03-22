import axios from "axios"

const state = {
    customer: null
}

const getters = {
    check: state => !! state.customer,
    customername: state => state.customer ? state.customer.username : '',
}

const mutations = {
    setCustomer(state, customer){
        state.customer = customer
    }
}

const actions = {
    async register(context, data){
        const response = await axios.post('/api/register' ,data);
        context.commit('setCustomer', response.data);
    },
    async login (context, data) {
        const response = await axios.post('/api/login', data);
        context.commit('setCustomer', response.data);
    },
    async logout (context) {
        const response = await axios.post('/api/logout');
        context.commit('setCustomer', null);
    },
    async currentUser(context){
        const response = await axios.get('/api/user');
        const user = response.data || null;
        context.commit('setCustomer', user);
    }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}