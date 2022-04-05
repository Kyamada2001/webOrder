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
        if(response.status === UNPROCESSABLE_CONTENT){
            context.commit('setRegisterErrorMessages', response.data.errors);
            return false;
        }else {
            context.commit('error/setCode', response.status, { root: true });
        }
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
        if(response.status == UNPROCESSABLE_CONTENT){
            context.commit('setLoginErrorMessages', response.data.errors);
            return false;
        }else{
            context.commit('error/setCode', response.status ,{ root: true });
        }
    },

    async logout (context) {
        const response = await axios.post('/api/logout');
        if(response.status === OK){
            context.commit('setCustomer', null);
            context.commit('setApiStatus', true);
            return false;
        }
        context.commit('setApiStatus', false);
        context.commit('error/setCode', response.status, { root: true });
    },

    async currentUser(context){
        context.commit('setApiStatus', null);
        const response = await axios.get('/api/user');
        if(response.status === OK){
            const user = response.data || null;
            context.commit('setCustomer', user);
            return false;
        }
        context.commit('setApiStatus', false);
        context.commit('error/setCode', response.status, { root: true });
    },
    clearErrorMessages(context){
        context.commit('setRegisterErrorMessages', null);
        context.commit('setLoginErrorMessages', null);
    }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}