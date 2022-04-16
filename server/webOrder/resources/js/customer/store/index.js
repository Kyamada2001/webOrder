import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import order from './order'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    order
  }
})

export default store