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
  index({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("admin/authors")
        .then((response) => {
          commit('SET_AUTHORS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  store({ commit }, author) {
    return new Promise((resolve, reject) => {
      axios.post("/admin/authors", author)
        .then((response) => {
          commit('ADD_AUTHOR', Object.assign(author, {id: response.data.id}))
          resolve(response)
        })
        .catch((error) => 
        { 
          reject(error) 
        })
    })
  },
}
