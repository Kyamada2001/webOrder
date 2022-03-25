import axios from "axios"
import { OK } from '../../util'
import { UNPROCESSABLE_CONTENT } from '../../util'
import { CREATED } from '../../util'

const state = {
    customer: null,
    apiStatus: null,
    loginErrorMessages: null,
    registerErrorMessages: null,
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
    setLoginErrorMessages(state ,errorMessages){
        state.loginErrorMessages = errorMessages
    },
    setRegisterErrorMessages(state ,errorMessages){
        state.registerErrorMessages = errorMessages
    }
}

const actions = {
    async register(context, data){
        context.commit('setApiStatus', null);
        const response = await axios.post('/api/register' ,data).catch(err => err.response || err);
        if(response.status === CREATED){
            context.commit('setCustomer', response.data);
            context.commit('setRegisterErrorMessages', null);
            context.commit('setApiStatus', true);
            return false;
        }
        //エラーだった場合
        context.commit('setApiStatus' ,false);
        context.commit('error/setErrorCode', response.status, { root: true });
        if(response.status === UNPROCESSABLE_CONTENT){
            context.commit('setRegisterErrorMessages', response.data.errors);
            return false;
        }
        context.commit('setRegisterErrorMessages', response.data.errors);
    },

    async login(context, data) {
        context.commit('setApiStatus',null);
        const response = await axios.post('/api/login', data).catch(err => err.response || err);
        //エラー判定
        if(response.status == OK){
            context.commit('setApiStatus',true);
            context.commit('setCustomer', response.data);
            context.commit('setLoginErrorMessages', null);
            return false;
        }
        //エラーだった場合
        context.commit('setApiStatus', false);
        context.commit('error/setCode', response.status ,{ root: true });
        if(response.status == UNPROCESSABLE_CONTENT){
            context.commit('setLoginErrorMessages', response.data.errors);
            return false;
        }
        //別のエラーだった場合の保険
        context.commit('setLoginErrorMessages', response.data.errors);
        
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