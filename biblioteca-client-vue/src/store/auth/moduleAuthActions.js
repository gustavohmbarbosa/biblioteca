/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import axios from "@/axios.js"
import storage from "./storage.js"

export default {
  // addItem({ commit }, item) {
  //   return new Promise((resolve, reject) => {
  //     axios.post("/api/data-list/products/", {item: item})
  //       .then((response) => {
  //         commit('ADD_ITEM', Object.assign(item, {id: response.data.id}))
  //         resolve(response)
  //       })
  //       .catch((error) => { reject(error) })
  //   })
  // },
  doLogin({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      axios.post("admin/login", payload)
        .then((response) => {
          dispatch('setUser', response.data.user)
          dispatch('setToken', response.data.access_token)
          resolve(response)
        })
        .catch((error) => { reject(error) })
      })
  },
  checkToken({ dispatch, state }) {
    if(state.token) {
      return new Promise.resolve(state.token)
    }

    const token = storage.getLocalToken()

    if(!token) {
      return Promise.reject(new Error("Token Inválido"))
    }

    dispatch('setToken', token)
    return dispatch('loadSession')
  },
  loadSession({ dispatch }) {
    return new Promise(async (resolve, reject) => {
      try {
        const user = await storage.getLocalUser()
        dispatch('setUser', user)
        resolve()
      } catch (err) {
        dispatch('signOut')
        reject(err)
      }
    })
  },
  setUser({ commit }, payload) {
    storage.setLocalUser(payload)
    commit("SET_USER", payload)
  },
  setToken({ commit }, payload) {
    storage.setLocalToken(payload)
    storage.setHeaderToken(payload)
    commit("SET_TOKEN", payload)
  },
  signOut({ dispatch }) {
    storage.setHeaderToken('')
    storage.deleteLocalToken()
    dispatch('setUser', {})
    dispatch('setToken', '')
  }
}
