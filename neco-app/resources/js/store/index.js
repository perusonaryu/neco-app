import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import cat from './cat'

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth,
    cat,
  }
})