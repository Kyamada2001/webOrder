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
        const response = await axios.post('/api/register' ,{
            //register: this.registerForm view側でまとめて送りたい
            username: data.username,
            email: data.email,
            password: data.password,
            password_confirmation: data.password_confirmation,
        });
        context.commit('setCustomer', response.data);
        console.log(response.data);
    }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}