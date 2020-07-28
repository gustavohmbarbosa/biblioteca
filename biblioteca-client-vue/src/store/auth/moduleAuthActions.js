/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import axios from "@/axios.js"

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
  setUser({ commit }, payload) {
    commit("SET_USER", payload)
  },
  setToken({ commit }, payload) {
    commit("SET_TOKEN", payload)
  },
}
