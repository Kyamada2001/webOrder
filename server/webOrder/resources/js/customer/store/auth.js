import axios from "axios"
import { OK } from '../../util'
import { UNPROCESSABLE_CONTENT } from '../../util'


const state = {
    customer: null,
    apiStatus: null,
    loginErrorMessage: null,
}

const getters = {
    check: state => !! state.customer,
    customername: state => state.customer ? state.customer.username : '',
}

const mutations = {
    setCustomer(state, customer){
        state.customer = customer
    },
    setApiStatus (state, status) {
        state.apiStatus = status
    },
    setLoginErrorMessage(state ,loginErrorMessage){
        state.loginErrorMessage = loginErrorMessage
    }
}

const actions = {
    async register(context, data){
        const response = await axios.post('/api/register' ,data);
            context.commit('setCustomer', response.data);
    },
    async login(context, data) {
        context.commit('setApiStatus',null);
        const response = await axios.post('/api/login', data).catch(err => err.response || err);
        //エラー判定
        console.log(response.status);
        if(response.status == OK){
            context.commit('setApiStatus',true);
            context.commit('setCustomer', response.data);
            context.commit('setLoginErrorMessage', null);
            return false;
        }
        
        if(response.status == UNPROCESSABLE_CONTENT){
            context.commit('setLoginErrorMessage', response.data.errors);
            context.commit('setApiStatus', false);
            return false;
        }
        context.commit('setLoginErrorMessage', response.data.errors);
        context.commit('setApiStatus', false);
        context.commit('error/setCode', response.status ,{ root: true });
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