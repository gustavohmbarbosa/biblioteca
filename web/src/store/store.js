import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";

import state from "./state"
import getters from "./getters"
import mutations from "./mutations"
import actions from "./actions"

// Modules
import moduleAuth from './auth/moduleAuth.js'

Vue.use(Vuex)


export default new Vuex.Store({
    getters,
    mutations,
    state,
    actions,
    modules: {
      auth: moduleAuth,
    },
    strict: process.env.NODE_ENV !== 'production',
    plugins: [createPersistedState({
      paths: ['auth'],
    })],
})
