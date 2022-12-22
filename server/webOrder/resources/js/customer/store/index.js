import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import order from './order'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    IMG_PATH_HEAD: '/storage/',
    NO_IMG_PATH: 'images/noimage.png',
  },
  modules: {
    auth,
    error,
    order
  }
})

export default store